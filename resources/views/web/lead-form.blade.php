<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Inquiry | Srusti Academy</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap">
    
    <style>
        :root {
            /* University Blue Palette */
            --primary-color: #125875;
            --primary-light: #1e7ba3;
            --accent-color: #f39c12;
            --text-color: #2c3e50;
            --bg-overlay: rgba(255, 255, 255, 0.85);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-image: url("{{ asset('web/img/bg/university-bg.png') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            color: var(--text-color);
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background Elements */
        .bg-circle {
            position: fixed;
            z-index: 1;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: float 20s infinite alternate;
        }

        .circle-1 {
            width: 400px;
            height: 400px;
            background: rgba(18, 88, 117, 0.4);
            top: -100px;
            right: -100px;
        }

        .circle-2 {
            width: 300px;
            height: 300px;
            background: rgba(243, 156, 18, 0.2);
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(50px, 50px) scale(1.1); }
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.2) 0%, rgba(18, 88, 117, 0.7) 100%);
            z-index: 2;
        }

        .container-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 650px;
            animation: slideUp 1s cubic-bezier(0.23, 1, 0.32, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 30px;
            padding: 50px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.15), 
                        0 10px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-section img {
            max-width: 150px;
            margin-bottom: 15px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-title h2 {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 32px;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .form-title p {
            color: #555;
            font-size: 16px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            color: #444;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label span {
            color: #e74c3c;
        }

        .form-control {
            width: 100%;
            background: rgba(248, 250, 252, 0.8);
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px 20px;
            font-size: 16px;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            color: var(--text-color);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 10px 20px rgba(18, 88, 117, 0.08), 0 0 0 4px rgba(18, 88, 117, 0.05);
            background: #fff;
            transform: translateY(-2px);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23125875' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 18px;
        }

        textarea.form-control {
            resize: none;
        }

        .btn-submit {
            display: block;
            width: 100%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: #fff;
            padding: 18px;
            border: none;
            border-radius: 16px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            margin-top: 35px;
            box-shadow: 0 15px 30px rgba(18, 88, 117, 0.25);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            position: relative;
            overflow: hidden;
        }

        .btn-submit::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn-submit:hover::after {
            left: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(18, 88, 117, 0.35);
            filter: brightness(1.05);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .alert-success {
            background: rgba(212, 237, 218, 0.9);
            color: #155724;
            border: none;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 1;
            transform: translateY(0);
        }

        .alert-success.fade-out {
            opacity: 0;
            transform: translateY(-20px);
            margin-bottom: -50px;
            padding-top: 0;
            padding-bottom: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .alert-success i {
            margin-right: 15px;
            font-size: 20px;
        }

        @media (max-width: 576px) {
            .form-card {
                padding: 30px 20px;
            }
            .form-title h2 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>

    <!-- Background Elements -->
    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>

    <div class="container-wrapper">
        <div class="form-card">
            
            <div class="form-title">
                <h2>Apply Now</h2>
                <p>Start your journey with Srusti Academy today.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admission.request.store') }}" method="post">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="name">First Name & Last Name <span>*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your full name" value="{{ old('name') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="father_name">Father's Name<span>*</span></label>
                            <input type="text" name="father_name" id="father_name" class="form-control" placeholder="Father's name" value="{{ old('father_name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone Number<span>*</span></label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter the number" value="{{ old('phone') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="email">Email Address<span> *</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter the email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="educational_qualification">Current Qualification<span> *</span></label>
                            <select name="educational_qualification" id="educational_qualification" class="form-control" required>
                                <option value="">-- Select Qualification --</option>
                                @foreach($qualifications as $qualification)
                                <option value="{{ $qualification->title }}" @if(old('educational_qualification') == $qualification->title) selected @endif>{{ $qualification->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="board">Board<span> *</span></label>
                            <input type="text" name="board" id="board" class="form-control" placeholder="School/College/University" value="{{ old('board') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="total_mark">Total Mark<span> *</span></label>
                            <input type="text" name="total_mark" id="total_mark" class="form-control" placeholder="Enter total mark" value="{{ old('total_mark') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="total_percentage">Total Percentage<span> *</span></label>
                            <input type="text" name="total_percentage" id="total_percentage" class="form-control" placeholder="Enter percentage" value="{{ old('total_percentage') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="lead_source">How do you know about it?<span> *</span></label>
                            <select name="lead_source" id="lead_source" class="form-control" required>
                                <option value="">-- Select Source --</option>
                                @foreach($lead_sources as $source)
                                <option value="{{ $source->id }}" @if(old('lead_source') == $source->id) selected @endif>{{ $source->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="program">Interested Program<span> *</span></label>
                            <select name="program" id="program" class="form-control" required>
                                <option value="">-- Select Program --</option>
                                @foreach($programs as $program)
                                <option value="{{ $program->id }}" @if(old('program') == $program->id) selected @endif>{{ $program->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Any Message or Query <span>*</span></label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Tell us more about your interest..." required>{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn-submit">
                    Send Inquiry Now
                </button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('web/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/js/bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Auto hide success alert
            setTimeout(function() {
                $('.alert-success').addClass('fade-out');
                setTimeout(function() {
                    $('.alert-success').remove();
                }, 500);
            }, 3000);
        });
    </script>

</body>
</html>
