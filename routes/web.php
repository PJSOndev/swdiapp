<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\FamilyMembersController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SyncController;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

// Show OTP input form
Route::get('/verify-otp', [SessionsController::class, 'showOtpForm'])->name('otp.verify.view');

// Handle OTP form submission
Route::post('/verify-otp', [SessionsController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/google', [GoogleController::class, 'redirectToProvider'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleProviderCallback'])->name('google.callback');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');

Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::get('/', function () {
    return redirect('sign-in');
})->middleware('guest');

Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
    return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
    return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
    Route::get('reports', function () {
        return view('pages.reports');
    })->name('reports');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

    Route::get('tables', function () {
        return view('pages.tables');
    })->name('tables');
    Route::get('tables', [BeneficiaryController::class, 'showTables'])->name('tables');
    Route::get('/beneficiaries', [BeneficiaryController::class, 'showTables'])->name('beneficiaries.index');
    Route::get('/beneficiaries/{id}', [BeneficiaryController::class, 'show'])->name('beneficiaries.show');

    Route::post('/beneficiaries', [BeneficiaryController::class, 'store'])->name('beneficiaries.store');
    Route::put('/beneficiaries/update', [BeneficiaryController::class, 'update'])->name('beneficiaries.update');

    Route::get('/beneficiaries/{hhid}/employable-skills', [BeneficiaryController::class, 'getEmployableSkills']);
    Route::get('/beneficiaries/{hhid}/employment', [BeneficiaryController::class, 'getEmployment']);
    Route::get('/beneficiaries/{hhid}/income', [BeneficiaryController::class, 'getIncome']);
    Route::get('/beneficiaries/{hhid}/social_security', [BeneficiaryController::class, 'getSocialSec']);
    Route::get('/beneficiaries/{hhid}/availment_of_family_members_of_accessible_health_centers', [BeneficiaryController::class, 'getAccessibilityHealth']);
    Route::get('/beneficiaries/{hhid}/health_condition_of_family_members', [BeneficiaryController::class, 'getHealthCondition']);
    Route::get('/beneficiaries/{hhid}/number_of_meals', [BeneficiaryController::class, 'getNumberMeals']);
    Route::get('/beneficiaries/{hhid}/nutritional_status_of_children_five_year_and_below', [BeneficiaryController::class, 'getnutritionalStatusChildren']);
    Route::get('/beneficiaries/{hhid}/family_access_to_safe_drinking_water', [BeneficiaryController::class, 'getFamilyAccessToSafeDrinkingWater']);
    Route::get('/beneficiaries/{hhid}/family_access_to_sanitary_toilet', [BeneficiaryController::class, 'getFamilyAccessToSanitaryToilet']);
    Route::get('/beneficiaries/{hhid}/family_garbage_disposal_practice', [BeneficiaryController::class, 'getFamilyGarbageDisposalPractice']);
    Route::get('/beneficiaries/{hhid}/construction_materials_of_the_roof', [BeneficiaryController::class, 'getConstructionMaterialsOfTheRoof']);
    Route::get('/beneficiaries/{hhid}/construction_materials_of_the_outer_walls', [BeneficiaryController::class, 'getConstructionMaterialsOfTheOuterWalls']);
    Route::get('/beneficiaries/{hhid}/tenure_status_of_housing_unit', [BeneficiaryController::class, 'getTenureStatusOfHousingUnit']);
    Route::get('/beneficiaries/{hhid}/lighting_facility_of_the_house', [BeneficiaryController::class, 'getLightingFacilityOfTheHouse']);
    Route::get('/beneficiaries/{hhid}/functional_literacy', [BeneficiaryController::class, 'getFunctionalLiteracy']);
    Route::get('/beneficiaries/{hhid}/sea', [BeneficiaryController::class, 'getSeaData']);
    Route::get('/beneficiaries/{hhid}/family_functioning', [BeneficiaryController::class, 'getFamilyFunctioning']);
    Route::get('/beneficiaries/{hhid}/family_awareness', [BeneficiaryController::class, 'getFamilyAwareness']);
    Route::get('/beneficiaries/{hhid}/swfe', [BeneficiaryController::class, 'getSwfeData']);
    Route::get('/beneficiaries/{hhid}/ifesa', [BeneficiaryController::class, 'getifesaData']);
    Route::get('/beneficiaries/{hhid}/osin', [BeneficiaryController::class, 'getOsin']);
    Route::get('/beneficiaries/{hhid}/soi', [BeneficiaryController::class, 'getSoi']);


    Route::get('/export-beneficiary-list', [BeneficiaryController::class, 'exportList'])->name('export.beneficiary.list');
    Route::get('rtl', function () {
        return view('pages.rtl');
    })->name('rtl');
    Route::get('virtual-reality', function () {
        return view('pages.virtual-reality');
    })->name('virtual-reality');
    Route::get('notifications', function () {
        return view('pages.notifications');
    })->name('notifications');
    Route::get('static-sign-in', function () {
        return view('pages.static-sign-in');
    })->name('static-sign-in');
    Route::get('static-sign-up', function () {
        return view('pages.static-sign-up');
    })->name('static-sign-up');
    Route::get('user-management', function () {
        return view('pages.laravel-examples.user-management');
    })->name('user-management');
    Route::get('/user-management', [UserController::class, 'index'])->name('user-management');
    Route::get('user-profile', function () {
        return view('pages.laravel-examples.user-profile');
    })->name('user-profile');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
});


Route::get('/beneficiaries/{id}/edit-gis', [FamilyMembersController::class, 'editGIS']);
Route::get('/beneficiaries/{id}/family-composition', [FamilyMembersController::class, 'getFamilyComposition']);
Route::get('/beneficiaries/{id}/family-composition', [BeneficiaryController::class, 'getFamilyComposition']);
Route::get('/beneficiaries/{hhid}/family-members', [App\Http\Controllers\BeneficiaryController::class, 'getFamilyMembers']);

Route::get('/sync-data', [SyncController::class, 'syncToAndroid']);

