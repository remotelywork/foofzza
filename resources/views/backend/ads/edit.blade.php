@extends('backend.layouts.app')
@section('title')
    {{ __('Update Ads') }}
@endsection
@section('content')
<div class="main-content">
    <div class="page-title">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="title-content">
                        <h2 class="title">{{ __('Update Ads') }}</h2>
                        <a href="{{ route('admin.ads.index') }}" class="title-btn"><i data-lucide="arrow-left"></i>{{ __('Back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="site-card">
                    <div class="site-card-body">
                        <form action="{{ route('admin.ads.update',$ads->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xxl-12">
                                    <div class="site-input-groups">
                                        <label for="" class="box-input-label">{{ __('Title') }}</label>
                                        <input type="text" name="title" class="box-input mb-0" value="{{ $ads->title }}" required/>
                                    </div>
                                </div>
                                <div class="col-xxl-4">
                                    <div class="site-input-groups">
                                        <label class="box-input-label" for="">{{ __('Amount') }} <i data-lucide="info" data-bs-toggle="tooltip" data-bs-original-title="User will showing ads then get this amount"></i></label>
                                        <div class="input-group joint-input">
                                            <input type="number" name="amount" class="form-control" value="{{ $ads->amount }}"/>
                                            <span class="input-group-text">{{ $currency }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4">
                                    <div class="site-input-groups">
                                        <label class="box-input-label" for="">{{ __('Duration') }}</label>
                                        <div class="input-group joint-input">
                                            <input type="number" name="duration" class="form-control" value="{{ $ads->duration }}"/>
                                            <span class="input-group-text">{{ __('Seconds') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4">
                                    <div class="site-input-groups">
                                        <label class="box-input-label" for="">{{ __('Max Show Limit') }} <i data-lucide="info" data-bs-toggle="tooltip" data-bs-original-title="User can't showing ads after reached the limit"></i></label>
                                        <div class="input-group joint-input">
                                            <input type="number" name="max_views" class="form-control" value="{{ $ads->max_views }}"/>
                                            <span class="input-group-text">{{ __('Times') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if(setting('ads_system','permission'))
                                <div class="col-xxl-4">
                                    <div class="site-input-groups">
                                        <label class="box-input-label" for="">{{ __('Plan') }}</label>
                                        <select name="plan_id" class="form-select">
                                            <option selected disabled>{{ __('Select Plan') }}</option>
                                            @foreach ($plans as $plan)
                                            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-xxl-4">
                                        <div class="site-input-groups">
                                            <label class="box-input-label" for="">{{ __('Ads Type') }}</label>
                                            <select name="type" class="form-select" id="adsType">
                                                <option selected disabled>{{ __('Select Type') }}</option>
                                                <option value="link" @selected($ads->type->value == 'link')>{{ __('Link/URL') }}</option>
                                                <option value="image" @selected($ads->type->value == 'image')>{{ __('Banner/Image') }}</option>
                                                <option value="script" @selected($ads->type->value == 'script')>{{ __('Script/Code') }}</option>
                                                <option value="youtube" @selected($ads->type->value == 'youtube')>{{ __('Youtube Embed Link') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-8">
                                        <div class="site-input-groups" id="typeValueField">
                                            <div id="link" class="d-none">
                                                <label class="box-input-label" for="">{{ __('Link') }}</label>
                                                <input type="text" name="link" class="box-input mb-0" value="{{ $ads->type->value == 'link' ? $ads->value : '' }}"/>
                                            </div>
                                            <div id="youtube" class="d-none">
                                                <label class="box-input-label" for="">{{ __('Youtube Embed Link') }}</label>
                                                <input type="text" name="youtube" class="box-input mb-0" value="{{ $ads->type->value == 'youtube' ? $ads->value : '' }}"/>
                                            </div>
                                            <div id="script" class="d-none">
                                                <label class="box-input-label" for="">{{ __('Script') }}</label>
                                                <textarea name="script" class="form-textarea" cols="30" rows="4">{{ $ads->type->value == 'script' ? $ads->value : '' }}</textarea>
                                            </div>
                                            <div id="image" class="d-none">
                                                <label class="box-input-label" for="">{{ __('Image') }}</label>
                                                <div class="wrap-custom-file">
                                                    <input type="file" name="image" id="adsImage"
                                                           accept=".gif, .jpg, .png"/>
                                                    <label for="adsImage" @if($ads->type->value == 'image') class="file-ok"  style="background-image: url({{ asset($ads->value) }})" @endif>
                                                        <img class="upload-icon"
                                                             src="{{ asset('global/materials/upload.svg') }}" alt=""/>
                                                        <span>{{ __('Update Image') }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="site-input-groups">
                                        <label class="box-input-label" for="">{{ __('Status') }}</label>
                                        <div class="switch-field same-type">
                                            <input type="radio" id="active" name="status" value="active" @checked($ads->status->value == 'active')/>
                                            <label for="active">{{ __('Active') }}</label>
                                            <input type="radio" id="inactive" name="status" value="inactive" @checked($ads->status->value == 'inactive')/>
                                            <label for="inactive">{{ __('Inactive') }}</label>
                                            <input type="radio" id="pending" name="status" value="pending" @checked($ads->status->value == 'pending')/>
                                            <label for="pending">{{ __('Pending') }}</label>
                                            <input type="radio" id="rejected" name="status" value="rejected" @checked($ads->status->value == 'rejected')/>
                                            <label for="rejected">{{ __('Rejected') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-12">
                                    <h6 class="mb-2">{{ __('Ads Schedule') }}</h6>
                                    <button type="button" class="site-btn-xs primary-btn mb-2" id="addNewSchedule">{{ __('Add New') }}</button>
                                    <div id="scheduleList">
                                        @foreach ($ads->schedules ?? [] as $schedule)
                                        <div class="row schedule-item">
                                            <div class="col-xxl-4">
                                                <div class="site-input-groups">
                                                    <label class="box-input-label" for="">{{ __('Days') }}</label>
                                                    <select name="schedules[{{ $loop->iteration }}][day]" class="form-select" required>
                                                        <option value="saturday" @selected($schedule['day'] == 'saturday')>{{ __('Saturday') }}</option>
                                                        <option value="sunday" @selected($schedule['day'] == 'sunday')>{{ __('Sunday') }}</option>
                                                        <option value="monday" @selected($schedule['day'] == 'monday')>{{ __('Monday') }}</option>
                                                        <option value="tuesday" @selected($schedule['day'] == 'tuesday')>{{ __('Tuesday') }}</option>
                                                        <option value="wednesday" @selected($schedule['day'] == 'wednesday')>{{ __('Wednesday') }}</option>
                                                        <option value="thursday" @selected($schedule['day'] == 'thursday')>{{ __('Thursday') }}</option>
                                                        <option value="friday" @selected($schedule['day'] == 'friday')>{{ __('Friday') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3">
                                                <div class="site-input-groups">
                                                    <label for="" class="box-input-label">{{ __('Start Time') }}</label>
                                                    <input type="time" name="schedules[{{ $loop->iteration }}][start_time]" class="box-input mb-0" value="{{ $schedule['start_time'] }}" required/>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3">
                                                <div class="site-input-groups">
                                                    <label for="" class="box-input-label">{{ __('End Time') }}</label>
                                                    <input type="time" name="schedules[{{ $loop->iteration }}][end_time]" class="box-input mb-0" value="{{ $schedule['end_time'] }}" required/>
                                                </div>
                                            </div>
                                            <div class="col-xxl-2">
                                                <button type="button" class="site-btn-sm red-btn mt-4 deleteSchedule">
                                                    <i data-lucide="x"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="action-btns">
                                <button type="submit" class="site-btn-sm primary-btn me-2">
                                    <i data-lucide="check"></i>
                                    {{ __('Update Ads') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        (function ($) {
            "use strict";

            var selectedType = $('#adsType').val();
            visibilityField(selectedType);

            $('#adsType').change(function() {
                visibilityField($(this).val());
            });

            function visibilityField(selectedType)
            {
                $('#typeValueField > div').addClass('d-none'); // Hide all
                $('#' + selectedType).removeClass('d-none'); // Show selected
            }

            var counter = "{{ is_array($ads->schedules) ? count($ads->schedules) + 1 : 1 }}";
            $('#addNewSchedule').on('click',function(){
                let element = `<div class="row schedule-item">
                                <div class="col-xxl-4">
                                    <div class="site-input-groups">
                                        <label class="box-input-label" for="">{{ __('Days') }}</label>
                                        <select name="schedules[`+counter+`][day]" class="form-select" required>
                                            <option value="saturday">{{ __('Saturday') }}</option>
                                            <option value="sunday">{{ __('Sunday') }}</option>
                                            <option value="monday">{{ __('Monday') }}</option>
                                            <option value="tuesday">{{ __('Tuesday') }}</option>
                                            <option value="wednesday">{{ __('Wednesday') }}</option>
                                            <option value="thursday">{{ __('Thursday') }}</option>
                                            <option value="friday">{{ __('Friday') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3">
                                    <div class="site-input-groups">
                                        <label for="" class="box-input-label">{{ __('Start Time') }}</label>
                                        <input type="time" name="schedules[`+counter+`][start_time]" class="box-input mb-0" required/>
                                    </div>
                                </div>
                                <div class="col-xxl-3">
                                    <div class="site-input-groups">
                                        <label for="" class="box-input-label">{{ __('End Time') }}</label>
                                        <input type="time" name="schedules[`+counter+`][end_time]" class="box-input mb-0" required/>
                                    </div>
                                </div>
                                <div class="col-xxl-2">
                                    <button type="button" class="site-btn-sm red-btn mt-4 deleteSchedule">
                                        <i data-lucide="x"></i>
                                    </button>
                                </div>
                            </div>`;
                counter++;
                $('#scheduleList').append(element);
                refreshIcon();
            });

            $(document).on('click','.deleteSchedule',function(){
                $(this).closest('.schedule-item').remove()
            });

            let refreshIcon = () => {
                lucide.createIcons();
            }
        })(jQuery);
    </script>
@endsection
