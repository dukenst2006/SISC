<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\StoreCompanyInfo;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** @var string $ID_SALT the salt used to check the form integrity */
    const ID_SALT = 'YVmrMN5Q9RdIcwP977TuEiT6t0rkVb3pEwiGErsS';

    /**
     * Show a company information.
     *
     * @param int $id the company id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id = 1)
    {
        $company = Company::find($id);

        if ($company == null) {
            abort(404);
        }

        $company_hash = $this->generateHash($id);

        return view('company/details')->with([
            'company'      => $company,
            'company_hash' => $company_hash,
        ]);
    }

    /**
     * Generate an hash from an id.
     *
     * @param mixed $id the id used to create the hash.
     *
     * @return string the final hash.
     */
    private function generateHash($id)
    {
        return sha1(self::ID_SALT.$id);
    }

    /**
     * Show all companies.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll()
    {
        $companies = company::paginate(15);

        return view('company/list')->with('companies', $companies);
    }

    /**
     * Update the company information.
     *
     * @param StoreCompanyInfo $request
     *
     * @return Response
     */
    public function update(StoreCompanyInfo $request)
    {
        $info = $request->all();
        $company_id = (int) $info['id'];
        $company_hash = $info['company_hash'];

        // Check if the hash from the form is valid
        if (!$this->checkHash($company_hash, $company_id)) {
            return back()->with('error', 'Error: wrong company id in the submitted form.');
        }

        // Check if the user can update companies
        if (!Gate::allows('update-company')) {
            return back()->with('error', 'Error: you do not have the permissions to edit the company information.');
        }

        $company = Company::find($company_id);
        // Update the company info
        $company['name'] = $info['name'];
        $company['address'] = $info['address'];
        $company['city'] = $info['city'];
        $company['postcode'] = $info['postcode'];
        $company['country'] = $info['country'];
        $company['vat'] = $info['vat'];
        $company['email'] = $info['email'];
        $company['telephone'] = $info['telephone'];
        $company['mobile'] = $info['mobile'];

        if (!$company->isDirty() || $company->save()) {
            $message['success'] = 'The company information was updated!';
        } else {
            $message['error'] = 'An error occurred while saving the company information. Please try again.';
        }

        return back()->with($message);
    }

    /**
     * Check the integrity of an hash.
     *
     * @param string $hash the company hash
     * @param int    $id   the company id
     *
     * @return bool true if the hash matches the id, false otherwise.
     */
    private function checkHash($hash, $id)
    {
        return $this->generateHash($id) === $hash;
    }
}
