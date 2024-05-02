@extends('frontend.layouts.main')

@section('main-container')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{url('frontend/img/breadcrumb-bg.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-text">
                    <h2>BMI calculator</h2>
                    <div class="bt-option">
                        <a href="{{ url('/user') }}">Home</a>
                        <span>BMI calculator</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- BMI Calculator Section Begin -->
<section class="bmi-calculator-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title chart-title">
                    <span>check your body</span>
                    <h2>BMI CALCULATOR CHART</h2>
                </div>
                <div class="chart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Bmi</th>
                                <th>WEIGHT STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="point">Below 18.5</td>
                                <td>Underweight</td>
                            </tr>
                            <tr>
                                <td class="point">18.5 - 24.9</td>
                                <td>Healthy</td>
                            </tr>
                            <tr>
                                <td class="point">25.0 - 29.9</td>
                                <td>Overweight</td>
                            </tr>
                            <tr>
                                <td class="point">30.0 - and Above</td>
                                <td>Obese</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-title chart-calculate-title">
                    <span>check your body</span>
                    <h2>CALCULATE YOUR BMI</h2>
                </div>
                <div class="chart-calculate-form">
                    <p>BMI, or Body Mass Index, is a numerical measure of a person's body weight in relation to their height. It's a widely used indicator of whether someone is underweight, normal weight, overweight, or obese. Calculating your BMI can give you insight into your general health and help you understand your weight category</p>
                    <form id="bmiForm">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" id="heightInput" placeholder="Height / cm">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" id="weightInput" placeholder="Weight / kg">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" id="ageInput" placeholder="Age">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" id="sexInput" placeholder="Sex">
                            </div>
                            <div class="col-sm-6">
                                <button type="button" onclick="calculateBMI()">Calculate</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" onclick="clearForm()">Clear</button>
                            </div>
                        </div>
                    </form>
                    <div id="result"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function calculateBMI() {
        // Get input values
        const height = parseFloat(document.getElementById('heightInput').value) / 100; // Convert height to meters
        const weight = parseFloat(document.getElementById('weightInput').value);
        const age = parseInt(document.getElementById('ageInput').value);
        const sex = document.getElementById('sexInput').value;

        // Check if inputs are valid
        if (!height || !weight || !age || !sex) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter valid values for height, weight, age, and sex.',
            });
            return;
        }

        // Calculate BMI
        const bmi = weight / (height * height);

        // Display result in a SweetAlert modal
        let resultText = `Your BMI is ${bmi.toFixed(2)}. `;
        if (bmi < 18.5) {
            resultText += 'You are underweight.';
        } else if (bmi >= 18.5 && bmi < 25) {
            resultText += 'You are within the normal weight range.';
        } else if (bmi >= 25 && bmi < 30) {
            resultText += 'You are overweight.';
        } else {
            resultText += 'You are obese.';
        }

        Swal.fire({
            icon: 'info',
            title: 'BMI Result',
            html: resultText,
            showCloseButton: true,
        });
    }

    function clearForm() {
        document.getElementById('heightInput').value = '';
        document.getElementById('weightInput').value = '';
        document.getElementById('ageInput').value = '';
        document.getElementById('sexInput').value = '';
    }
</script>
<!-- BMI Calculator Section End -->
@endsection