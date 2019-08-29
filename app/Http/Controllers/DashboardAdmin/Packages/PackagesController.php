<?php

namespace App\Http\Controllers\DashboardAdmin\Packages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\CandidateInfo;
use App\PostJob;
use Input;
use App\CandidateExperience;
use App\Packages;
use App\packagecount;
use Session;
use App\attribute;
use App\Http\Requests\AddCandidateAdminFormRequest;
class PackagesController extends Controller
{
    public function index()
    {
    $Packages= Packages::all();//with('CanInfo')->where('type','=','candidate')->orderBy('created_at','DESC')->get();
    return view('DashbordAdminPanel.Packages.index',compact('Packages'));
    }
    public function updatePackages($id)
{
  $Packages= Packages::FindOrFail($id);
  $attribute= attribute::all();
  // dd( $candidateadmin->CanInfo->CanExperince->start_date);
   return view('DashbordAdminPanel.Packages.edit',compact('Packages','attribute'));
}


public function updateattrval( Request $request)
{

$updateval=DB::table('package_attribute')
->where('packages_id',$request['packId'])
->where('attribute_id',$request['id'])
->update(['Value'=>$request['val']]);
return 1;
}
public function updateattrvalyear( Request $request)
{
$updateval=DB::table('package_attribute')
->where('packages_id',$request['packId'])
->where('attribute_id',$request['id'])
->update(['Valueyear'=>$request['val']]);
return 1;
}
public function packagesedit( Request $request)
{
    try
    {
        $Packages = Packages::find($request['id']);
        $Packages->name= $request->name;
        $Packages->price= $request->price;
        $Packages->Priceyear=$request->Priceyear;
        $Packages->description=$request->description;
        $Packages->save();
        $Url='/Packages/'.$request['id'].'/edit';
        return redirect($Url);
    }
    catch(Exception $e) 

    {
    return redirect('/');
    }
 
}
public function Delattribute($attrid,$packid)
{
    try
    {
        // if 
        $packagecount=packagecount::where('attribute_id',$attrid)
        ->first();
        if($packagecount==null || $packagecount==[])
        {
            $query=DB::table('package_attribute')
            ->where('attribute_id',$attrid)
            ->where('packages_id',$packid)
            ->first();
            if($query!=[])
            DB::table('package_attribute')->delete($query->id); 
        }
        else
        {
            Session::flash('flash', "you cannot delete it");
            $Url='/Packages/'.$packid.'/edit';
            return redirect ($Url);
        }
      
    }
    catch(Exception $e) 
    {
    return redirect('/');
    }
 
}

public function addNewattribute(Request $request)
{
    try
    {
       
  
      $name=$request['name'];
       $Value=$request['Value'];
       $Valueyear=$request['Valueyear'];
       $n=count($name);
       for($i=0;$i<$n;$i++)
       {
           // if Exsist
           $packarrtribute=DB::table('package_attribute')
           ->where('packages_id',$request['packid'])
           ->where('attribute_id',$name[$i])
           ->first();
          // dd($packarrtribute,$name,$request['packid']);
           if($packarrtribute==null || $packarrtribute==[])
           {
              //add it
              $Packages = Packages::find($request['packid']);
              $Packages->getpackattribute()->attach($name[$i], ['Value'=>$Value[$i],'Valueyear'=>$Valueyear[$i]]);
           }
           else
           {
            Session::flash('flash', "already Exsists");
            $Url='/Packages/'.$request->packid.'/edit';
            return redirect ($Url); 
           }
           //
       }
       

      
    }
    catch(Exception $e) 
    {
    return redirect('/');
    }
 
}


}