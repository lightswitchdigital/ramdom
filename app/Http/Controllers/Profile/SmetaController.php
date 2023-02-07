<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Mail\NewBuildRequestMail;
use App\Mail\NewLoanRequestMail;
use App\Models\BuildRequest;
use App\Models\LoanRequest;
use App\Models\User;
use App\Models\UserPricelist;
use App\Models\UserSave;
use App\Services\Projects\SmetaGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Cast\Object_;
use function PHPUnit\Framework\isInstanceOf;

class SmetaController extends Controller
{
    private $smeta;

    public function __construct(SmetaGateway $smeta)
    {
        $this->smeta = $smeta;
    }

    public function index()
    {
        $user = Auth::user();
        $saveFile = $user->userSave()->first();

        return view('profile.smeta.index', compact('user', 'saveFile'));
    }

    public function saveInputData(Request $request)
    {
        $this->validate($request, []);

        $user = Auth::user();

        $data = $request->all();
        $price = $this->getCalculatedPrice($data);

        if ($save = $user->userSave()->first()) {

            $save->update([
                'data' => $data,
                'price' => $price
            ]);
        } else {
            $save = UserSave::create([
                'user_id' => $user->id,
                'data' => $data,
                'price' => $price
            ]);
        }

        return [
            'success' => true,
            'price' => $price
        ];
    }

    private function getCalculatedPrice($data)
    {
        return $this->smeta->calculatePrice($data);
    }

    public function pricelist()
    {
        $user = Auth::user();
        $saveFile = $user->userPricelist()->first();

        return view('profile.smeta.pricelist', compact('user', 'saveFile'));
    }

    public function savePricelistData(Request $request)
    {
        $this->validate($request, []);

        $user = Auth::user();

        $data = $request->all();

        if ($save = $user->userPricelist()->first()) {
            $save->update([
                'data' => $data
            ]);
        } else {
            $save = UserPricelist::create([
                'user_id' => $user->id,
                'data' => $data
            ]);
        }

        return [
            'success' => true,
        ];
    }

    public function developers()
    {
        $developers = User::where('type', User::TYPE_ENTITY)->where('status', User::STATUS_ACTIVE)->get();
        return view('profile.smeta.developers', compact('developers'));
    }

    public function developersSave(Request $request)
    {
        $this->validate($request, [
            'developer_id' => ['required', 'numeric']
        ]);

        $user = Auth::user();
        $save = $user->userSave;
        if (!$save) {
            abort(400);
        }

        $developer = User::find($request['developer_id']);
        if (!$developer) {
            session()->flash('error', 'Произошла ошибка при выборе застройщика');

            return [
                'success' => false,
                'redirectTo' => route('profile.smeta.developers')
            ];
        }

        $br = BuildRequest::create([
            'user_id' => $user->id,
            'developer_id' => $request['developer_id'],
            'status' => BuildRequest::STATUS_ACTIVE,
            'text' => $request['text'],
            'data' => $save->data,
            'price' => $save->price
        ]);

        Mail::to([$developer->email, $developer->company_email])->send(new NewBuildRequestMail($developer, $br));

        session()->flash('success', 'Запрос на строительство был успешно отправлен. В ближайшее время с вами свяжутся');

        return [
            'success' => true,
            'redirectTo' => route('profile.index')
        ];
    }

    public function loan()
    {
        return view('profile.loan');
    }

    public function downloadDocs(Request $request)
    {
        $this->validate($request, [

        ]);

        $user = Auth::user();

        $path = "/var/www/ramdom-data/$user->id/";
        $projectName = "Новый проект";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0777);
        }

        $save = $user->userSave->data;
        $pricelist = new \stdClass();
        if ($user->userPricelist) {
            $pricelist = $user->userPricelist->data;
        }

        $user = Auth::user();

        $userInfo = [
            "Клиент" => $user->name . " " . $user->last_name,
            "Телефон" => $user->phone,
            "Адрес эл. почты" => $user->email
        ];

        // Generating docs
        $this->smeta->getDocs($save, $pricelist, $path, $projectName, "", $userInfo);

        $zip_path = $path . "smeta.zip";
        $zip = new \ZipArchive();
        $zip->open($zip_path, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $zip->addFile($path . "smeta_internal.pdf", "смета-внутренняя.pdf");
        if ($user->isDeveloper()) {
            $zip->addFile($path . "smeta_zak.pdf", "смета-закупочная.pdf");
            $zip->addFile($path . "smeta_zak_rassh.pdf", "смета-закупочная-расширенная.pdf");
        }
        $zip->close();

        return response()->download($zip_path);
    }

    public function downloadClientsDocs(Request $request, BuildRequest $buildReq)
    {
        $this->validate($request, [

        ]);

        $client = $buildReq->user;
        $user = Auth::user();

        $path = "/var/www/ramdom-data/$client->id/";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0777);
        }

        $save = new \stdClass();
        if ($client->userSave) {
            $save = $client->userSave->data;
        }
        $pricelist = new \stdClass();
        if ($user->userPricelist) {
            $pricelist = $user->userPricelist->data;
        }

        $logoPublicPath = null;
        if ($request['logo']) {
            $logoPublicPath = $request['logo']->store('userlogos', 'public');
            $logoPublicPath = \Storage::disk('public')->path($logoPublicPath);
        }

        $companyInfo = [
            "Компания" => Auth::user()->company_name,
            "Юр. Адрес" => Auth::user()->company_address
        ];

        // Generating docs
        $this->smeta->getDocs($save, $pricelist, $path, $request['project_name'] ?: "Новый проект", $logoPublicPath ?: "", $companyInfo);

        $zip_path = $path . $user->name . "-" . $user->last_name . ".zip";

        $zip = new \ZipArchive();
        $zip->open($zip_path, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $zip->addFile($path . "smeta_internal.pdf", "смета-внутренняя.pdf");
        $zip->addFile($path . "smeta_zak.pdf", "смета-закупочная.pdf");
        $zip->addFile($path . "smeta_zak_rassh.pdf", "смета-закупочная-расширенная.pdf");
        $zip->close();

        return response()->download($zip_path);
    }

    public function constructorGetPrice(Request $request)
    {
        $this->validate($request, [

        ]);

        try {
            $price = $this->smeta->calculatePrice($request->all());

            return $price;
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    public function requestLoan(Request $request)
    {
        $this->validate($request, [
            'amount' => ['required', 'numeric', 'min:1000000'],
            'message' => ['nullable', 'string', 'max:1000'],
            'place' => ['required', 'mimes:pdf,png,jpg,jpeg', 'max:2000'],
            'floor_plan' => ['required', 'mimes:pdf,png,jpg,jpeg', 'max:2000'],
            'smeta' => ['required', 'mimes:pdf,png,jpg,jpeg', 'max:2000'],
            'building_price' => ['required', 'numeric', 'min:1000000']
        ]);

        $user = Auth::user();

        if (!$user->docs_verified) {
            return redirect()->route('profile.settings.index')
                ->with('error', 'Вам нужно сначала пройти верификацию документов');
        }

        $req = LoanRequest::create([
            'user_id' => $user->id,
            'text' => $request['text'],
            'status' => LoanRequest::STATUS_UNWATCHED,
            'amount' => $request['amount'],
            'building_price' => $request['building_price'],
            'place' => $request['place']->store('userdocs/' . $user->id, 'public'),
            'floor_plan' => $request['floor_plan']->store('userdocs/' . $user->id, 'public'),
            'smeta' => $request['smeta']->store('userdocs/' . $user->id, 'public'),
        ]);
        if ($request['passport_1'] && $request['passport_2']) {
            $req->update([
                'passport_1' => $request['passport_1']->store('userdocs/' . $user->id, 'public'),
                'passport_2' => $request['passport_2']->store('userdocs/' . $user->id, 'public')
            ]);
        }
        Mail::to("sireax@yandex.ru")->send(new NewLoanRequestMail($req));

        return redirect()->back()->with('success', 'Запрос успешно отправлен');
    }
}
