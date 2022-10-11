<?php

use App\Http\Controllers\V1\Admin\AdminController;
use App\Http\Controllers\V1\Admin\ChannelController;
use App\Http\Controllers\V1\Admin\SiteSettingsController;
use App\Http\Controllers\V1\General\SearchController;
use App\Http\Controllers\V1\Public\PagesController;
use App\Http\Controllers\V1\Admin\TransactionController;
use App\Http\Controllers\V1\Admin\FAQController;
use App\Http\Controllers\V1\Admin\LoanController;
use App\Http\Controllers\V1\Agent\AgentController;
use App\Http\Controllers\V1\Agent\CommentController;
use App\Http\Controllers\V1\General\NotificationController;
use App\Http\Controllers\V1\General\ReportGenController;
use App\Http\Controllers\V1\UserController;
use App\Models\V1\Admin\Transaction;
use Illuminate\Support\Facades\Route;

Route::get('/panel', [AdminController::class, 'home'])->name('admin.home')->middleware(['auth']);

Route::middleware(['auth', 'agent_or_admin'])->group(function () {
    
    Route::get('/panel/agents', [AdminController::class, 'agents'])->name('admin.agents');
    Route::get('/panel/requests', [AdminController::class, 'requests'])->name('admin.requests');
    Route::get('/panel/request/resolve/{id}', [AdminController::class, 'requestResolve'])->name('admin.requests.resolve')->middleware(['admin_only']);
    Route::get('/panel/request/pop/{id}', [AdminController::class, 'popOut'])->name('admin.requests.pop')->middleware(['admin_only']);

    Route::get('/panel/customers', [AdminController::class, 'customers'])->name('admin.customers');
    Route::get('/panel/customer/search', [SearchController::class, 'customerSearch'])->name('admin.customer.search');
    Route::get('/panel/user/show/{userid}', [AdminController::class, 'showUser'])->name('admin.user.show');
    // Route::get('/panel/user/show/{userid}', [AdminController::class, 'showUser'])->name('admin.user.show');

    //user details
    Route::post('/panel/bank/update/{userid}/{bankid}', [UserController::class, 'updateBank'])->name('panel.bank.update')->middleware(['admin_only']);
    Route::post('/panel/bank/new/{userid}', [UserController::class, 'newBank'])->name('panel.bank.new');
    Route::post('/panel/kin/add/{userid}', [UserController::class, 'newKin'])->name('panel.kin.add');
    Route::post('/panel/kin/edit/{userid}/{kinid}', [UserController::class, 'updateKin'])->name('panel.kin.update')->middleware(['admin_only']);


    Route::post('/panel/channel/create', [AdminController::class, 'channelCreate'])->name('channel.channel.create');
    Route::get('/panel/agents/deactivate/{id}', [AdminController::class, 'deactivateAgent'])->name('admin.agents.deactivate')->middleware('admin_only');
    Route::get('/panel/notificaion', [NotificationController::class, 'index'])->name('nofitication');

    Route::post('/agent/customer/deposite/{customerid}', [TransactionController::class, 'store'])->name('agent.customer.deposit.index');
    Route::post('/channel/customer/alt/deposit', [TransactionController::class, 'storeAlt'])->name('agent.customer.dep');



    Route::get('/panel/customer/deposits', [TransactionController::class, 'depositTransactions'])->name('admin.customer.deposit');
    Route::get('/panel/customer/withdrawal', [TransactionController::class, 'withdrawTransactions'])->name('admin.customer.withdrawal');

    Route::any('/panel/trx/edit/{trxId}', [TransactionController::class, 'updateTrx'])->name('deposit.com.based.update');

    Route::post('/panel/deposit/comment/{depositId}', [CommentController::class, 'store'])->name('deposit.comment');
    Route::get('/panel/comments', [CommentController::class, 'comments'])->name('comments');

    Route::get('/panel/support', [PagesController::class, 'support'])->name('admin.support');
    Route::post('/send-complain', [PagesController::class, 'complain'])->name('send.complain');
    //Route::post('/comp-test', [PagesController::class, 'complain']);
    Route::get('/complain/resolve/{id}', [PagesController::class, 'resolveComplain'])->name('complain.resolve');
    Route::get('/profile/settings', [PagesController::class, 'settings'])->name('profile.set');
    Route::post('/send-review', [PagesController::class, 'sendreview'])->name('send-review');

    Route::get('/panel/site-settings', [SiteSettingsController::class, 'settingsIndex'])->name('site.settings');
    Route::get('/panel/chats', [AdminController::class, 'chartPage'])->name('charts');

    //channels
    Route::get('/panel/channel', [ChannelController::class, 'index'])->name('admin.channels');
    // Route::post('/panel/channel/create', [ChannelController::class, 'create'])->name('panel.channel.create');


    // transactions
    Route::get('/panel/user/transactions/{userid}', [TransactionController::class, 'singleUserTransaction'])->name('admin.user.transaction');
    Route::get('/panel/user/transactions/pdf/{userid}', [ReportGenController::class, 'adminGeneratingUserReport'])->name('admin.user.pdf');
    Route::get('/panel/agent/transaction/{agentid}', [AgentController::class, 'allTransactionByAgent'])->name('panel.agent.transactions');
    Route::get('/panel/agent/transactions/pdf/{agentid}', [ReportGenController::class, 'agentUserTransactionReport'])->name('admin.agent.user.pdf');

    Route::get('/panel/all/transactions', [TransactionController::class, 'xTransaction'])->name('all.transactions');


    Route::post('/agent/withdraw', [AgentController::class, 'initiateWithdraw'])->name('agent.withdraw');

    Route::get('/agent/fetchuser/{id}', [AgentController::class, 'getUser'])->name('agent.fetch.user');


    Route::get('/panel/site/settings', [SiteSettingsController::class, 'index'])->name('panel.site.settings');
    Route::get('/panel/site/sms', [SiteSettingsController::class, 'sms'])->name('settings.sms');
    Route::get('/panel/site/debit', [SiteSettingsController::class, 'debit'])->name('settings.debit');
    Route::get('/panel/site/credit', [SiteSettingsController::class, 'credit'])->name('settings.credit');
    Route::get('/panel/site/user_data', [SiteSettingsController::class, 'user_data'])->name('settings.user_data');


    Route::get('/panel/faq/category', [FAQController::class, 'categoryIndex'])->name('admin.faq.category.index');
    Route::post('/panel/faq/category/store', [FAQController::class, 'categoryStore'])->name('admin.faq.category.store');
    Route::post('/panel/faq/category/{category:slug}/update', [FAQController::class, 'categoryUpdate'])->name('admin.faq.category.update');
    Route::get('/panel/faq/category/{category:slug}/delete', [FAQController::class, 'categoryDestroy'])->name('admin.faq.category.delete');

    Route::get('/panel/faqs', [FAQController::class, 'faqIndex'])->name('admin.faq.index');
    Route::post('/panel/faq/store', [FAQController::class, 'faqStore'])->name('admin.faq.store');
    Route::post('/panel/faq/faq/{faq:slug}/update', [FAQController::class, 'faqUpdate'])->name('admin.faq.update');
    Route::get('/panel/faq/faq/{faq:slug}/delete', [FAQController::class, 'faqDestroy'])->name('admin.faq.delete');

    Route::get('/panel/loan', [LoanController::class, 'loan'])->name('admin.loan');
});
