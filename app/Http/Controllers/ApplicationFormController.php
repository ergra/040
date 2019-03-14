<?php

namespace App\Http\Controllers;

use App\Company;
use App\Participant;
use App\Application;

use Illuminate\Http\Request;

class ApplicationFormController extends Controller
{
    public function submit(Request $request) {

        $this->validate($request, [
            'form.company_name' => 'required|string',
            'form.company_email' => 'required|email',
            'form.company_phone' => 'required',
            'form.course_id' => 'required|numeric',
            'form.course_date' => 'required|numeric',
            'participants.*.name' => 'required|string',
        ]);
        
        $company = Company::where('company_email', request('form.company_email'))->first();

        if(empty($company)) {
            $company = new Company(request('form'));
            $company->save();
        }
        
        foreach(request('participants') as $p) {

            $p['company_id'] = $company->id;
            $participant = Participant::where('email', $p['email'])->first();

            if(empty($participant)) {
                $participant = new Participant($p);
                $participant->save();
            }
            
            $application = Application::where([['course_id','=',request('form.course_id')],['course_date','=', request('form.course_date')],['participant_id','=', $participant->id]])->first();

            if(empty($application)) {
                $application = new Application;
                $application->course_id = request('form.course_id');
                $application->course_date = request('form.course_date');
                $application->participant_id = $participant->id;
                $application->save();
            }

            
        }

        return response()->json(null, 200);

    }
}
