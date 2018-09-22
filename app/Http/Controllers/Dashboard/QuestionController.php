<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JobQquestions;
class QuestionController extends Controller
{

     //show all questions  
        public function index(JobQquestions $question)
        { 
          $question = $question->paginate(5);
          
          return view('Dashboardadmin.Postjob.question_index',compact('question'));

        }



      //delete question
        public function destroy($id, JobQquestions $question)
        {
           try
           {

              $question->find($id)->delete();
              return redirect('/adminpanel/questions')->withFlashMessage('question deleted correctly ');
            }
            catch(Exception $e) 

            {

            return redirect('/');

            }
        }


      //delete more row at once
        public function deleteid(Request $request) 
        {
            try
            {

              $delid=$request->input('delid');
              JobQquestions::whereIn('id', $delid)->delete();
          
              return redirect('/adminpanel/questions')->withFlashMessage(' Selected Question Deleted Correctly ');
            }
            catch(Exception $e) 

            {

            return redirect('/');

            }
        }



      //create edit form 
       public function edit( JobQquestions $question ,$id) 
       {
       
            $data = $question->find($id);
            return view('Dashboardadmin.Postjob.edit_question', compact('data'));

       }


      //update question 
       public function update(Request $req, $id) 
       {
        
         try
         {
              $questionupdate = JobQquestions::find($id);

              $questionupdate->fill($req->all())->save();

              return Redirect()->back()->withFlashMessage('Updated Done');
         }

         catch(Exception $e) 
         {
         return redirect('/');
         }
      }


      //search in questions 
      public function search(Request $request) 
      {

          try
          {

            $question = JobQquestions::where('question', 'LIKE', '%' . $request->s . '%')
            ->orWhere('id', 'LIKE', '%' . $request->s . '%')
            ->orWhere('weight', 'LIKE', '%' . $request->s . '%');
            $question =$question->get();
          
            return view('Dashboardadmin.Postjob.question_search', compact('question'));
          }
          catch(Exception $e) 

          {

          return redirect('/');

          }
      }
}
