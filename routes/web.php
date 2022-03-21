<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\profileProController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', [Controller::class, 'showWelcome'])->name('welcome.show');
    Route::get('/about', [Controller::class, 'showAbout'])->name('about.show');
    Route::get('/faq', [Controller::class, 'showFaq'])->name('faq.show');
    Route::get('/login', [Controller::class, 'showLogin'])->name('login.show');
    Route::post('/login',[Controller::class, 'login'])->name('login.post');
    Route::post('/logout',[Controller::class, 'logout'])->name('logout');
    Route::get('/client_registration', [Controller::class, 'showClientRegistrationForm'])->name('clientRegistration.show');
    Route::post('/client_registration',[Controller::class, 'storeClient'])->name('clientRegistration.post');
    Route::get('/vet_registration', [Controller::class, 'showVetRegistrationForm'])->name('vetRegistration.show');
    Route::post('/vet_registration',[Controller::class, 'storeVet'])->name('vetRegistration.post');
    Route::get('/creneaux',[Controller::class, 'showCreneaux'])->name('creneaux.show');
    Route::get('/create_slots',[Controller::class, 'showCreateSlotsForm'])->name('createSlots.show');
    Route::post('/create_slots',[Controller::class, 'storeSlots'])->name('createSlots.post');
    Route::get('/create_animal', [Controller::class, 'createAnimal'])->name('createAnimal.show');
    Route::post('/create_animal', [Controller::class, 'storeAnimal'])->name('createAnimal.post');
    Route::get('/client_profile/{IDClient}', [Controller::class, 'showClient'])-> where('IDClient','[0-9]+')->name('client.show');
    Route::get('/client_profile/{IDClient}/{IDAnimal}', [Controller::class, 'showAnimal'])-> where('IDClient','[0-9]+') -> where('IDAnimal','[0-9]+') ->name('animal.show');    
    Route::get('/confirmation/{IDCreneau}',[Controller::class, 'showConfirmSlotForm'])->where('IDCreneau', '[0-9]+')->name('confirmSlot.show');
    Route::post('/confirmation/{IDCreneau}',[Controller::class, 'storeSlotConfirmation'])->where('IDCreneau', '[0-9]+')->name('confirmSlot.post');
    Route::get('/vet_profile',[Controller::class, 'showAllVetProfiles']) ->name('allVetProfile.show');
    Route::get('/vet_profile/{IDVeto}',[Controller::class, 'showVetProfile']) -> where('IDVeto','[0-9]+') ->name('vetProfile.show');
    Route::get('/appointments', [Controller::class, 'showClientAppointments'])->name('appointments.show');
    Route::get('/clients_list',[Controller::class, 'showClientsList'])->name('clientsList.show');
    Route::get('/booked_slots', [Controller::class, 'showBookedSlotsList']) -> name ('bookedSlots.show');
    Route::post('/zip_search_results',[Controller::class, 'searchByZipCode']) -> name ('zipSearchResult');
    Route::post('/name_search_results',[Controller::class, 'searchByName']) -> name ('nameSearchResult');

