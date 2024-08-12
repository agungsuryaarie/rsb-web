@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <x-breadcrumb menu="{{ $menu }}"></x-breadcrumb>
        <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="hidden_id" value="{{ $profile->user_id ?? '' }}">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <div class="upload-profile">
                                @if (isset($profile->picture))
                                    <img src="{{ url('storage/userUpload/' . $profile->picture) }}" id="preview"
                                        alt="Profile Picture">
                                @else
                                    <img src="{{ asset('back-template/img/avatar/avatar-1.png') }}" id="preview"
                                        alt="Default Profile Picture">
                                @endif
                                <div class="round">
                                    <input type="file" name="picture" id="picture" accept=".jpg, .jpeg, .png"
                                        onchange="previewImg(event)">
                                    <i class="fa fa-camera" style="color: #fff;"></i>
                                </div>
                            </div>
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Posts</div>
                                    <div class="profile-widget-item-value">{{ $post }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Followers</div>
                                    <div class="profile-widget-item-value">6,8K</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Following</div>
                                    <div class="profile-widget-item-value">2,1K</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ Auth::user()->name }}
                                <div class="form-group">
                                    <x-textarea name="tentang" label="Tentang Anda">{{ $profile->tentang ?? '' }}
                                    </x-textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <x-inputRow type="text" name="real_name" label="Nama Lengkap"
                                    value="{{ $profile->real_name ?? '' }}"></x-inputRow>
                                <x-inputRow type="text" name="tlp" label="Phone" value="{{ $profile->tlp ?? '' }}">
                                </x-inputRow>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <x-dropdown name="jens_kel" label="Gender">
                                        <option value="Pria"
                                            {{ isset($profile) && 'Pria' == $profile->jens_kel ? 'selected' : '' }}>Pria
                                        </option>
                                        <option value="Wanita"
                                            {{ isset($profile) && 'Wanita' == $profile->jens_kel ? 'selected' : '' }}>
                                            Wanita
                                        </option>
                                    </x-dropdown>
                                </div>
                                <div class="col-md-6 col-12">
                                    <x-dropdown name="status" label="Status">
                                        <option value="1"
                                            {{ isset($profile) && '1' == $profile->status ? 'selected' : '' }}>Lajang
                                        </option>
                                        <option value="2"
                                            {{ isset($profile) && '2' == $profile->status ? 'selected' : '' }}>Berpacaran
                                        </option>
                                        <option value="3"
                                            {{ isset($profile) && '3' == $profile->status ? 'selected' : '' }}>Bertunangan
                                        </option>
                                        <option value="4"
                                            {{ isset($profile) && '4' == $profile->status ? 'selected' : '' }}>Menikah
                                        </option>
                                        <option value="5"
                                            {{ isset($profile) && '5' == $profile->status ? 'selected' : '' }}>Hubungan
                                            Tanpa Status</option>
                                        <option value="6"
                                            {{ isset($profile) && '6' == $profile->status ? 'selected' : '' }}>Rumit
                                        </option>
                                        <option value="7"
                                            {{ isset($profile) && '7' == $profile->status ? 'selected' : '' }}>Berpisah
                                        </option>
                                        <option value="8"
                                            {{ isset($profile) && '8' == $profile->status ? 'selected' : '' }}>Bercerai
                                        </option>
                                        <option value="9"
                                            {{ isset($profile) && '9' == $profile->status ? 'selected' : '' }}>Janda
                                        </option>
                                        <option value="10"
                                            {{ isset($profile) && '10' == $profile->status ? 'selected' : '' }}>Duda
                                        </option>
                                    </x-dropdown>
                                </div>
                            </div>
                            <div class="row">
                                <x-inputRow type="date" name="tgl_lahir" label="Tanggal Lahir"
                                    value="{{ $profile->tgl_lahir ?? '' }}"></x-inputRow>
                            </div>
                            <div class="form-group">
                                <x-textarea name="alamat" label="Alamat">{{ $profile->alamat ?? '' }}</x-textarea>
                            </div>
                            <div class="row">
                                <x-inputRow type="text" name="facebook" label="Facebook"
                                    value="{{ $profile->facebook ?? '' }}">
                                </x-inputRow>
                                <x-inputRow type="text" name="instagram" label="Instagram"
                                    value="{{ $profile->instagram ?? '' }}"></x-inputRow>
                            </div>
                            <div class="row">
                                <x-inputRow type="text" name="tiktok" label="Tiktok"
                                    value="{{ $profile->tiktok ?? '' }}">
                                </x-inputRow>
                                <x-inputRow type="text" name="twitter" label="Twitter"
                                    value="{{ $profile->twitter ?? '' }}">
                                </x-inputRow>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('script')
    <script>
        function previewImg() {
            const foto = document.querySelector('#picture');
            const img = document.querySelector('#preview');

            const fileFoto = new FileReader();
            fileFoto.readAsDataURL(foto.files[0]);

            fileFoto.onload = function(e) {
                img.src = e.target.result;
            }
        }
    </script>
@endsection
