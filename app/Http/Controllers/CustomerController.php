<?php



namespace App\Http\Controllers;




class CustomerController extends Controller {
    

    
    public function index() {
                    
        
        //$c1 = new \App\Models\Customer($clients[0][0],$clients[0][1],$clients[1][2]);
        
        //return view('customer.index',['client'=>$c1]);
    }
    
    
    public function clientList(){
        
        $clients = array(
        array('aa','sss','ff'),
        array('azz','sdfdss','dfff')
        );
        
        
        //$c1 = new \App\Models\Customer($clients[0][0],$clients[0][1],$clients[1][2]);
        
        return view('customer.index',['client'=>$clients[0][1]]);
        
    }
    
}
