@extends('backend.layouts.app')
@section('title')
    {{ __('Manage Referral') }}
@endsection
@section('content')
    <div class="main-content">
        <div class="page-title">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="title-content">
                            <h2 class="title">{{ __('Referrals') }}</h2>
                            @can('referral-create')
                                <div class="d-flex">
                                    <a href="{{ route('admin.referral.settings') }}" class="title-btn mx-2"> <i data-lucide="settings"></i> {{ __('Referral Rules Settings') }}</a>
                                    <button class="title-btn new-referral" type="button"> <i data-lucide="plus-circle"></i> {{ __('Add New') }}</button>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">

                <div class="col-xl-4 col-md-12">
                    <div class="site-card">
                        <div class="site-card-header">
                            <h3 class="title">{{ __('Deposit Bounty') }}</h3>
                            <div class="col-sm-6">
                                <form action="{{ route('admin.referral.status') }}" method="post" id="deposit-status">
                                    @csrf
                                    <input type="hidden" name="type" value="deposit_level">
                                    <div class="switch-field m-0">
                                        <input
                                            type="radio"
                                            id="deposit-1"
                                            name="status"
                                            @checked(setting('deposit_level'))
                                        />
                                        <label for="deposit-1" class="deposit-status toggle-switch">{{ __('Active') }}</label>
                                        <input
                                            type="radio"
                                            id="deposit-0"
                                            name="status"
                                            @checked(!setting('deposit_level'))
                                        />
                                        <label for="deposit-0" class="deposit-status toggle-switch">{{ __('Deactive') }}</label>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="site-card-body">
                            <p class="paragraph">{{ __('You can') }}
                                <strong>{{ __('Add').','. __('Edit').' '. __('or').' '. __('Delete') }}</strong> {{ __('any of the') }}
                                <strong>{{ __('Level Referred User Deposit Bounty') }}</strong></p>

                            @foreach($deposits as $raw)
                                <div class="single-gateway">
                                    <div class="gateway-name">
                                        <div class="gateway-title">
                                            <h4>{{  __('Level '). $raw->the_order }}</h4>
                                        </div>
                                    </div>
                                    <div class="gateway-right">
                                        <div class="gateway-status">
                                            <div class="site-badge success">{{ $raw->bounty }}%</div>
                                        </div>
                                        <div class="gateway-edit">
                                            @can('referral-edit')
                                                <a href="" type="button" class="edit-referral"
                                                   data-id="{{$raw->id}}"
                                                   data-editfor="{{ 'Update ' . $raw->type . ' level '. $raw->the_order }}"
                                                   data-bounty="{{ $raw->bounty }}"
                                                ><i data-lucide="edit-3"></i></a>
                                            @endcan
                                            @can('referral-delete')
                                                <a href="" class="red-bg ms-2 delete-referral" type="button"
                                                   data-id="{{$raw->id}}"
                                                   data-type="{{$raw->type}}"
                                                   data-target="{{  $raw->type . ' level '. $raw->the_order }}"
                                                ><i data-lucide="trash-2"></i></a>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12">
                    <div class="site-card">
                        <div class="site-card-header">
                            <h3 class="title">{{ __('Subscription Plan Bounty') }}</h3>
                            <div class="col-sm-6">
                                <form action="{{ route('admin.referral.status') }}" method="post" id="plan-status">
                                    @csrf
                                    <input type="hidden" name="type" value="subscription_plan_level">
                                    <div class="switch-field m-0">
                                        <input
                                            type="radio"
                                            id="plan-1"
                                            name="status"
                                            @checked(setting('subscription_plan_level'))
                                        />
                                        <label for="plan-1" class="plan-status toggle-switch">{{ __('Active') }}</label>
                                        <input
                                            type="radio"
                                            id="plan-0"
                                            name="status"
                                            @checked(!setting('subscription_plan_level'))
                                        />
                                        <label for="plan-0" class="plan-status toggle-switch">{{ __('Deactive') }}</label>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="site-card-body">
                            <p class="paragraph">{{ __('You can') }}
                                <strong>{{ __('Add').','. __('Edit').' '. __('or').' '. __('Delete') }}</strong> {{ __('any of the') }}
                                <strong>{{ __('Level Referred User Plan Subscription Bounty') }}</strong></p>

                            @foreach($plans as $plan)
                                <div class="single-gateway">
                                    <div class="gateway-name">
                                        <div class="gateway-title">
                                            <h4>{{  __('Level '). $plan->the_order }}</h4>
                                        </div>
                                    </div>
                                    <div class="gateway-right">
                                        <div class="gateway-status">
                                            <div class="site-badge success">{{ $plan->bounty }}%</div>
                                        </div>
                                        <div class="gateway-edit">
                                            @can('referral-edit')
                                                <a href="" type="button" class="edit-referral"
                                                   data-id="{{$plan->id}}"
                                                   data-editfor="{{ 'Update ' . $plan->type . ' level '. $plan->the_order }}"
                                                   data-bounty="{{ $plan->bounty }}"
                                                ><i data-lucide="edit-3"></i></a>
                                            @endcan
                                            @can('referral-delete')
                                                <a href="" class="red-bg ms-2 delete-referral" type="button"
                                                   data-id="{{$plan->id}}"
                                                   data-type="{{$plan->type}}"
                                                   data-target="{{  $plan->type . ' level '. $plan->the_order }}"
                                                ><i data-lucide="trash-2"></i></a>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Add New Level -->
        @can('referral-create')
            @include('backend.referral.include.__new_level_referral')
        @endcan
        <!-- Modal for Add New Level-->

        <!-- Modal for Edit Level -->
        @can('referral-edit')
            @include('backend.referral.include.__edit_level_referral')
        @endcan
        <!-- Modal for Edit Level-->

{{--        <!-- Modal for Delete Level -->--}}
        @can('referral-delete')
            @include('backend.referral.include.__delete_level_referral')
        @endcan
        <!-- Modal for Delete Level End-->

        @endsection
@section('script')
    <script>

        $('.new-referral').on('click',function (e) {
            "use strict";
            e.preventDefault();
            var type = $(this).data('type');
            $('.referral-type').val(type);
            $('#addNewReferral').modal('show');

        })

        $('.edit-referral').on('click',function (e) {
            "use strict";
            e.preventDefault();
            var id = $(this).data('id');
            var editFor = $(this).data('editfor');
            var bounty = $(this).data('bounty');

            var url = '{{ route("admin.referral.update",":id") }}';
            url = url.replace(':id', id);

            var form = document.getElementById("level-form");
            form.setAttribute("action", url);



            $('.referral-id').val(id);
            $('.edit-for').html(editFor);
            $('.bounty').val(bounty);

            $('#editReferral').modal('show');

        })
        $('.delete-referral').on('click',function (e) {
            "use strict";
            e.preventDefault();
            var id = $(this).data('id');
            var target = $(this).data('target');
            var type = $(this).data('type');

            var url = '{{ route("admin.referral.delete",":id") }}';
            url = url.replace(':id', id);

            var form = document.getElementById("level-delete");
            form.setAttribute("action", url);

            $('.target').html(target);
            $('.level-type').val(type);
            $('#deleteReferral').modal('show');

        })



        $(".toggle-switch").click(function (message) {
            let className = $(this).attr('class');
            var idNames = className.split(' ')[0]; // Split the class names into an array
            $("#"+idNames).submit();
        });

    </script>
@endsection
