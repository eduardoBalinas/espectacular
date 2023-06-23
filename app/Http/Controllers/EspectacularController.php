<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Images;

class EspectacularController extends Controller
{
    
    public function phrase(Request $request) {
        $insert = DB::insert('insert into phrases (phrase, background,avatar,created_at,updated_at) values (?, ?,?,?,?)', [$request->post()["phrase"],$request->post()["background"],$request->post()["avatar"],now(),now()]);
        if($insert) {
            return response()->json(["Message" => "The Insert was success", "status" => 200]);
        }
        return response()->json(["Message" => "Failed to insert phrase pls review your data", "status" => 404]);
    } 

    public function getAllPhrases(Request $request) {
        $phrases = DB::table('phrases')->get();
        if($phrases) {
            return response()->json(['data' => $phrases, "status" => 200]);
        }
        return response()->json(['Message' => "Failed to do request", "status" => 404]);
    }

    public function token() {
        return response()->json(["token" => csrf_token()]);
    }

    public function getPhraseById(Request $request, $id) {
        $phrase = DB::table("phrases")->find($id);
        if($phrase) {
            return response()->json(["data" => $phrase, "status" => 200]);
        }
        return response()->json(["Message" => "The id that your search dosent exist", "status" => 404]);
    }

    public function editPhrase(Request $request, $id) {

        $update = DB::table('phrases')->where("id","=",$id)->update(["phrase" => $request->all()["phrase"]  ]);
        if($update) {
            return response()->json(["Message" => "You are update the register: " . $id , "status" =>200]);
        }
        return response()->json(["Message" => "Failed to update the register: " . $id , "status" => $request->all()["phrase"]]);
    }

    public function deletePhrase(Request $request, $id) {
        $delete = DB::table("phrases")->where('id', '=', $id)->delete();
        if($delete) {
            return response()->json(["Message" => "The Phrase with id " . $id ."was delete", "status" => 200]);
        }
        return response()->json(["Message" => "Failed to delete phrase with id" . $id, "status" => 404]);
    }

    public function createImage(Request $request) {
        $validateData = DB::table("images")->where("phrase_id","=",$request->post()["phraseId"])->where("size", "=", $request->post()["size"])->get();
        if(count($validateData) > 0) {
            $updateData = DB::table("images")->where("phrase_id","=",$request->post()["phraseId"])->where("size", "=", $request->post()["size"])->update(["image_url" => $request->post()["url"], "updated_at" => now()]);
            if($updateData) {
                return response()->json(["Message" => "The image was update with the new url", "status" => 200]);
            }
            return response()->json(["Message" => "Failed to update the image pls review your data", "status" => 404]);

        }else {
            $insertImage = DB::insert("insert into images (image_url,size,phrase_id,created_at,updated_at) values (?,?,?,?,?)", [$request->post()["url"], $request->post()["size"], $request->post()["phraseId"], now(),now()]);
            if($insertImage) {
                return response()->json(["Message" => "The image was success upload", "status" => 200]);
            }
            return response()->json(["Message" => "Failed to upload the image pls review your data", "status" => 404]);
        }
    }

    public function imagesSize(Request $request, $size) {
        if($size != "1920X1080" && $size != "1280X720" && $size != "720X480") return response()->json(["Message" => "The size that your search dosent exist", "status" => 404]);
        $images = Images::select("*")
                        ->join("phrases", "phrases.id","=","images.phrase_id")
                        ->where("images.size", "=", $size)                
                        ->get();    
        return response()->json(["data" => $images, "status" => 200]);
    }

    public function templateSize(Request $request, $size) {
        if($size != "1920X1080" && $size != "1280X720" && $size != "720X480") return response()->json(["Message" => "The size that your search dosent exist", "status" => 404]);

    }


}
