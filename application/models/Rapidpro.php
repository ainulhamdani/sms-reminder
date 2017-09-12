<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rapidpro extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function getRelayer(){
        
    }
    
    public function postRelayer(){
        
    }
    
    public function getContacts($group='',$page=''){
        $headers = [
            'Authorization: Token 23ebc2f3f9583f91b00bde6323e2d6d0e6d1d9d0'
        ];
        $url = 'http://rapidpro.ona.io/api/v1/contacts.json';
        if($group!='') $url = $url.'?group='.$group;
        if($page!='') $url = $url.'&page='.$page;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);
        return $response;
    }
    
    // contact['name'] = string
    // contact[contact['tel'] = array of string
    // contact['groups'] = array of string
    // contact['fields'] = array of array(name=>value)
    public function postContacts($contact){
        $data = array('name' => $contact['name'],'urns'=>[]);
        foreach ($contact['tel'] as $t){
            array_push($data['urns'], 'tel:'.$t);
        }
        if(isset($contact['groups'])){
            $data['groups'] = array();
            foreach ($contact['groups'] as $g){
                array_push($data['groups'], $g);
            }
        }
        if(isset($contact['fields'])){
            $data['fields'] = array();
            foreach ($contact['fields'] as $fn=>$fv){
                $data['fields'][$fn] = $fv;
            }
        }
        $post = json_encode($data);
        $headers = [
            'Authorization: Token 23ebc2f3f9583f91b00bde6323e2d6d0e6d1d9d0',
            'Content-Type: application/json'
        ];
        $ch = curl_init('http://rapidpro.ona.io/api/v1/contacts.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST , 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // execute!
        $response = curl_exec($ch);
        if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);
        return $response;
    }
    
    public function deleteContacts(){
        
    }
    
    public function postContactAction(){
        
    }
    
    public function getGroups(){
        
    }
    
    public function getFields(){
        
    }
    
    public function postFields(){
        
    }
    
    public function getMessages(){
        
    }
    
    public function postMessageAction(){
        
    }
    
    public function getBroadcasts(){
        $headers = [
            'Authorization: Token 23ebc2f3f9583f91b00bde6323e2d6d0e6d1d9d0'
        ];
        $ch = curl_init('http://rapidpro.ona.io/api/v1/broadcasts.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);
        return $response;
    }
    
    public function postBroadcasts($text,$to){
        $data = array('urns' => [],'text'=> $text);
        foreach ($to as $t){
            array_push($data['urns'], 'tel:'.$t);
        }
        $post = json_encode($data);
        $headers = [
            'Authorization: Token 23ebc2f3f9583f91b00bde6323e2d6d0e6d1d9d0',
            'Content-Type: application/json'
        ];
        $ch = curl_init('http://rapidpro.ona.io/api/v1/broadcasts.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST , 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // execute!
        $response = curl_exec($ch);
        if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);
        return $response;
    }
    
    public function getLabels(){
        
    }
    
    public function postLabels(){
        
    }
    
    public function getCalls(){
        
    }
    
    public function getFlows(){
        
    }

    public function flowStart($flow,$to){
        $data = array('flow'=>$flow,'urns' => []);
        foreach ($to as $t){
            array_push($data['urns'], 'tel:'.$t);
        }
        $post = json_encode($data);
        
        $headers = [
            'Authorization: Token 23ebc2f3f9583f91b00bde6323e2d6d0e6d1d9d0',
            'Content-Type: application/json'
        ];
        $ch = curl_init('http://rapidpro.ona.io/api/v2/flow_starts.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST , 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // execute!
        $response = curl_exec($ch);
        if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);
        return $response;
    }
    
    public function getRuns(){
        
    }
    
    public function postRuns(){
        
    }
    
    public function getCampaigns(){
        
    }
    
    public function postCampaigns(){
        
    }
    
    public function getEvents(){
        
    }
    
    public function postEvents(){
        
    }
    
    public function deleteEvents(){
        
    }
}