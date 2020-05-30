<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\Artifact as ArtifactResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/saveartifact', function (Request $request) {
    $artifactToSave = App\Artifact::find($request->id);
    $artifactToSave->text_content = $request->text_content;
    $artifactToSave->xPosition = $request->xPosition;
    $artifactToSave->yPosition = $request->yPosition;
    $artifactToSave->save();
    return $artifactToSave;
});

Route::post('/newartifact', function (Request $request) {
    $newArtifact = new App\Artifact();
    $newArtifact->xPosition = 100;
    $newArtifact->yPosition = 100;
    $newArtifact->text_content = "Fuck me around!";
    $newArtifact->url = $request->url;
    $newArtifact->save();
    return response($newArtifact)->header('Access-Control-Allow-Origin', '*');
});

Route::post('/getartifacts', function (Request $request) {
    $url = $request->url;
    return App\Artifact::where('url', $url)->get();

});
