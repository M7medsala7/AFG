<?php

namespace App\Http\Controllers;
use App\User;
use App\CandidateInfo;
use App\SuccessStories;
use Illuminate\Http\Request;

class SucessStoriesController extends Controller
{
    

      //show all questions  
      public function index(SuccessStories $story)
      { 
        $story = $story->paginate(5);
        return view('Dashboardadmin.Stories.story_index',compact('story'));

      }




    //delete more row at once
      public function deleteid(Request $request) 
      {
         try
         {

            $delid=$request->input('delid');
            SuccessStories::whereIn('id', $delid)->delete();
        
            return redirect('/adminpanel/stories')->withFlashMessage(' Selected Story Deleted Correctly ');
          }
          catch(Exception $e) 

          {

          return redirect('/');

          }
      }

    

    //search in stories 
    public function search(Request $request) 
    {
        try
        {


          $story = SuccessStories::where('description', 'LIKE', '%' . $request->s . '%')
          ->orWhere('id', 'LIKE', '%' . $request->s . '%')
          ->orWhere('user_id', 'LIKE', '%' . $request->s . '%');
          $story =$story->get();
        
          return view('Dashboardadmin.Stories.story_search', compact('story'));
        }
        catch(Exception $e) 

        {

        return redirect('/');

        }
    }

    
      //create edit form 
      public function edit(SuccessStories $story ,$id) 
      {
      
          $data = $story->find($id);
         return view('Dashboardadmin.Stories.edit_story', compact('data'));

      }


     //update story 
      public function update(Request $req, $id) 
      {
       
        try
        {
              $storyupdate = SuccessStories::find($id);

              $storyupdate->fill($req->all())->save();

            return Redirect()->back()->withFlashMessage('Updated Done');
        }

        catch(Exception $e) 
        {
        return redirect('/');
        }
     }

}
