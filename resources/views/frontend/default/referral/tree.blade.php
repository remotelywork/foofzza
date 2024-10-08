@extends('frontend::layouts.user')
@section('title')
    {{ __('Referral Tree') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <div class="site-card">
                <div class="site-card-header">
                    <div class="title">{{ __('Referral Tree') }}</div>
                </div>
                <div class="site-card-body">
                    <section class="management-hierarchy">
                        <div class="hv-container">
                            <div class="hv-wrapper">
                                <div class="hv-item">
                                    @if($user->referrals->count() > 0)
                                        <section class="management-hierarchy">
                                            <div class="hv-container">
                                                <div class="hv-wrapper">
                                                    <!-- tree component -->
                                                    @include('frontend::referral.include.__tree',['levelUser' => $user,'level' => $level,'depth' => 1, 'me' => true])
                                                </div>
                                            </div>
                                        </section>
                                    @else
                                        <p>{{ __('No Referral user found') }}</p>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
