<?php

use Phalcon\Mvc\Controller;


class ApiController extends Controller
{
    public function indexAction()
    {

       
    }
    public function apiAction()
    {
        
        if ($this->request->has('tosearch')) {
            $search=$this->request->getPost('tosearch');
            $search = urlencode($search);
            
            $url="https://openlibrary.org/search.json?q=$search&mode=ebooks&has_fulltext=true";
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
            curl_setopt($ch, CURLOPT_URL, $url);
    
            $curlexec=curl_exec($ch);
    
            $book=json_decode($curlexec);
            $obj=$book->docs;

             echo "<pre>";
             print_r($obj);
             echo "</pre>";
            // die;
            $this->view->message=$obj;
           
            // die;
        }
        
    }
    public function bookAction()
    {
        if ($this->request->get('isbn')) {
            $isbn=$this->request->get('isbn');
            $url="https://openlibrary.org/api/books?bibkeys=".$isbn."&jscmd=details&format=json";

            $ch=curl_init();

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
            curl_setopt($ch, CURLOPT_URL, $url);
    
            $curlexec=curl_exec($ch);
            $val =((array)json_decode($curlexec))[$isbn];
            $this->view->data = $val;
            // print_r($val);
            // die;
        }
    }
    public function googlebookAction()
    {
    

    }
}
