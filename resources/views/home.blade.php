@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-xl-6">
        
        <div class="card text-white-transparent-7 mb-3 overflow-hidden">
        
        <div class="card-img-overlay d-block d-lg-none bg-blue rounded"></div>
        
        
        <div class="card-img-overlay d-none d-md-block bg-blue rounded" style="background-image: url(images/wave-bg.png); background-position: right bottom; background-repeat: no-repeat; background-size: 100%;"></div>
        
        
        <div class="card-img-overlay d-none d-md-block bottom-0 top-auto">
        <div class="row">
        <div class="col-md-8 col-xl-6"></div>
        <div class="col-md-4 col-xl-6 mb-n2">
        <img src="images/dashboard.svg" alt="" class="d-block ml-n3 mb-5" style="max-height: 310px" />
        </div>
        </div>
        </div>
        
        
        <div class="card-body position-relative">
        
        <div class="row">
        
        <div class="col-md-8">
        
        <div class="d-flex">
        <div class="mr-auto">
        <h5 class="text-white-transparent-8 mb-3">Weekly Earning</h5>
        <h3 class="text-white mt-n1 mb-1">$2,999.80</h3>
        <p class="mb-1 text-white-transparent-6 text-truncate">
        <i class="fa fa-caret-up"></i> <b>32%</b> increase compare to last week
        </p>
        </div>
        </div>
        <hr class="hr-transparent bg-white-transparent-2 mt-3 mb-3" />
        
        <div class="row">
        <div class="col-6 col-lg-5">
        <div class="mt-1">
        <i class="fa fa-fw fa-shopping-bag fs-28px text-black-transparent-5"></i>
        </div>
        <div class="mt-1">
        <div>Store Sales</div>
        <div class="font-weight-600 text-white">$1,629.80</div>
        </div>
        </div>
        <div class="col-6 col-lg-5">
        <div class="mt-1">
        <i class="fa fa-fw fa-retweet fs-28px text-black-transparent-5"></i>
        </div>
        <div class="mt-1">
        <div>Referral Sales</div>
        <div class="font-weight-600 text-white">$700.00</div>
        </div>
        </div>
        </div>
        <hr class="hr-transparent bg-white-transparent-2 mt-3 mb-3" />
        <div class="mt-3 mb-2">
        <a href="#" class="btn btn-yellow btn-rounded btn-sm pl-5 pr-5 pt-2 pb-2 fs-14px font-weight-600"><i class="fa fa-wallet mr-2 ml-n2"></i> Withdraw money</a>
        </div>
        <p class="fs-12px">
        It usually takes 3-5 business days for transferring the earning to your bank account.
        </p>
        </div>
        
        
        <div class="col-md-4 d-none d-md-block" style="min-height: 380px;"></div>
        
        </div>
        
        </div>
        
        </div>
        
        </div>
        
        
        <div class="col-xl-6">
        
        <div class="row">
        
        <div class="col-sm-6">
        
        <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-orange" style="min-height: 202px;">
        
        <div class="card-img-overlay mb-n4 mr-n4 d-flex" style="bottom: 0; top: auto;">
        <img src="images/order.svg" alt="" class="ml-auto d-block mb-n3" style="max-height: 105px" />
        </div>
        
        
        <div class="card-body position-relative">
        <h5 class="text-white-transparent-8 mb-3 fs-16px">New Orders</h5>
        <h3 class="text-white mt-n1">56</h3>
        <div class="progress bg-black-transparent-5 mb-2" style="height: 6px">
        <div class="progrss-bar progress-bar-striped bg-white" style="width: 80%"></div>
        </div>
        <div class="text-white-transparent-8 mb-4"><i class="fa fa-caret-up"></i> 16% increase <br />compare to last week</div>
        <div><a href="#" class="text-white d-flex align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ml-2 text-white-transparent-5"></i></a></div>
        </div>
        
        </div>
        
        
        <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-teal" style="min-height: 202px;">
        
        <div class="card-img-overlay mb-n4 mr-n4 d-flex" style="bottom: 0; top: auto;">
        <img src="images/visitor.svg" alt="" class="ml-auto d-block mb-n3" style="max-height: 105px" />
        </div>
        
        
        <div class="card-body position-relative">
        <h5 class="text-white-transparent-8 mb-3 fs-16px">Page Visitors</h5>
        <h3 class="text-white mt-n1">60.5k</h3>
        <div class="progress bg-black-transparent-5 mb-2" style="height: 6px">
        <div class="progrss-bar progress-bar-striped bg-white" style="width: 50%"></div>
        </div>
        <div class="text-white-transparent-8 mb-4"><i class="fa fa-caret-up"></i> 33% increase <br />compare to last week</div>
        <div><a href="#" class="text-white d-flex align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ml-2 text-white-transparent-5"></i></a></div>
        </div>
        
        </div>
        
        </div>
        
        
        <div class="col-sm-6">
        
        <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-pink" style="min-height: 202px;">
        
        <div class="card-img-overlay mb-n4 mr-n4 d-flex" style="bottom: 0; top: auto;">
        <img src="images/email.svg" alt="" class="ml-auto d-block mb-n3" style="max-height: 105px" />
        </div>
        
        
        <div class="card-body position-relative">
        <h5 class="text-white-transparent-8 mb-3 fs-16px">Unread email</h5>
        <h3 class="text-white mt-n1">30</h3>
        <div class="progress bg-black-transparent-5 mb-2" style="height: 6px">
        <div class="progrss-bar progress-bar-striped bg-white" style="width: 80%"></div>
        </div>
        <div class="text-white-transparent-8 mb-4"><i class="fa fa-caret-down"></i> 5% decrease <br />compare to last week</div>
        <div><a href="#" class="text-white d-flex align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ml-2 text-white-transparent-5"></i></a></div>
        </div>
        
        </div>
        
        
        <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-indigo" style="min-height: 202px;">
        
        <div class="card-img-overlay mb-n4 mr-n4 d-flex" style="bottom: 0; top: auto;">
        <img src="images/browser.svg" alt="" class="ml-auto d-block mb-n3" style="max-height: 105px" />
        </div>
        
        
        <div class="card-body position-relative">
        <h5 class="text-white-transparent-8 mb-3 fs-16px">Page Views</h5>
        <h3 class="text-white mt-n1">320.4k</h3>
        <div class="progress bg-black-transparent-5 mb-2" style="height: 6px">
        <div class="progrss-bar progress-bar-striped bg-white" style="width: 80%"></div>
        </div>
        <div class="text-white-transparent-8 mb-4"><i class="fa fa-caret-up"></i> 20% increase <br />compare to last week</div>
        <div><a href="#" class="text-white d-flex align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ml-2 text-white-transparent-5"></i></a></div>
        </div>
        
        </div>
        
        </div>
        
        </div>
        
        </div>
        
        </div>
        
</div>
@endsection
