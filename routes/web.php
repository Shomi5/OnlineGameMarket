<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\ProdajaController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UserAccountController;
use App\Http\Middleware\AdminAutorizacija;
use App\Http\Middleware\LoginAutorizacija;
use Illuminate\Support\Facades\Route;



Route::get("/",[ProdajaController::class,"index"]);
Route::get("/prodaja/{igra:Naziv}",[ProdajaController::class,"show"]);
Route::post("/prodaja",[ProdajaController::class,"kupiIgru"])->middleware(LoginAutorizacija::class);


Route::get("/register",[RegisterUserController::class,"create"]);
Route::post("/register",[RegisterUserController::class,"store"]);

Route::get("/login",[LoginUserController::class,"login"]);
Route::post("/login",[LoginUserController::class,"store"]);
Route::post("/logout",[LoginUserController::class,"destroy"])->middleware(LoginAutorizacija::class);


Route::get("/userAccount",[UserAccountController::class,"index"])->middleware(LoginAutorizacija::class);
Route::get("/userAccount/edit",[UserAccountController::class,"edit"])->middleware(LoginAutorizacija::class);
Route::patch("/userAccount",[UserAccountController::class,"update"])->middleware(LoginAutorizacija::class);


Route::get("/adminPanel",[AdminController::class,"index"])->middleware(AdminAutorizacija::class);
Route::get("/adminPanel/manipulacijaKorisnikom",[AdminController::class,"manipulacijaKorisnikom"])->middleware(AdminAutorizacija::class);

Route::post("/adminPanel/dodajKorisnika",[AdminController::class,"dodajKorisnika"])->middleware(AdminAutorizacija::class);
Route::get("/adminPanel/editKorisnika",[AdminController::class,"editKorisnika"])->middleware(AdminAutorizacija::class);
Route::patch("/adminPanel/updatePodataka",[AdminController::class,"updatePodataka"])->middleware(AdminAutorizacija::class);
Route::delete("/adminPanel/brisanjeKorisnika",[AdminController::class,"brisanjeKorisnika"])->middleware(AdminAutorizacija::class);

Route::get("adminPanel/upravljanjeVideoIgrama",[AdminController::class,"upravljanjeVideoIgrama"])->middleware(AdminAutorizacija::class);
Route::post("/adminPanel/dodajVideoIgru",[AdminController::class,"dodajVideoIgru"])->middleware(AdminAutorizacija::class);
Route::get("/adminPanel/editVideo",[AdminController::class,"editVideo"])->middleware(AdminAutorizacija::class);
Route::post("/adminPanel/dodajKljuc",[AdminController::class,"dodajKljuc"])->middleware(AdminAutorizacija::class);
Route::patch("/adminPanel/updateVideoIgre",[AdminController::class,"updateVideoIgre"])->middleware(AdminAutorizacija::class);
Route::delete("/adminPanel/obrisiIgru",[AdminController::class,"obrisiIgru"])->middleware(AdminAutorizacija::class);
Route::get("/adminPanel/upravljanjePromocijama",[AdminController::class,"upravljanjePromocijama"])->middleware(AdminAutorizacija::class);

