@extends('admin')

@section('content')


<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta row">
            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Customers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
            <div class="">
            <a class="btn btn-primary float-end" href="{{ url('customers') }}"> Back</a>
            </div>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <div class="widget-content widget-content-area br-8 p-5">

                    <form class="row g-3" id="regForm" action="{{route('customer.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab">
                            <div class="col-md-12">
                                <label for="name" class="form-label">Business Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <div class="col-md-12">
                                <label for="date_of_birth" class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input id="basicFlatpickr" value="2022-09-04" class="form-control flatpickr flatpickr-input active" name="date_of_birth" id="date_of_birth" type="text" placeholder="Select Date..">
                            </div>

                            <div class="col-md-12">
                                <label for="phone" class="form-label">Courrency <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>

                            

                            <div class="col-md-6">
                                <label for="opening_balance" class="form-label">Upload Logo<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="opening_balance">
                            </div>

                            <div class="col-md-6">
                                <label for="address" class="form-label">Website <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Business Contact <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Alternet Contact <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Website <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>

                            <div class="col-md-6">
                                <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="state" name="state">
                            </div>

                            <div class="col-md-6">
                                <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="country" name="country">
                            </div>

                            <div class="col-md-6">
                                <label for="zip_code" class="form-label">Zip Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code">
                            </div>
                            <div class="col-md-6">
                                <label for="zip_code" class="form-label">Land Mark <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code">
                            </div>
                            <div class="col-md-6">
                                <label for="zip_code" class="form-label">Time Zone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code">
                            </div>
                        </div>
                        <div style="overflow:auto;">
                            <div style="float:right;">
                                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>
                        <!-- <div class="col-12">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="layout-px-spacing">
<div class="middle-content container-xxl p-0">
<!-- MultiStep Form -->
    <form id="regForm" action="">

    <h1>Register:</h1>

    <!-- One "tab" for each step in the form: -->
    <div class="tab">Name:
    <p><input placeholder="First name..." oninput="this.className = ''"></p>
    <p><input placeholder="Last name..." oninput="this.className = ''"></p>
    </div>

    <div class="tab">Contact Info:
    <p><input placeholder="E-mail..." oninput="this.className = ''"></p>
    <p><input placeholder="Phone..." oninput="this.className = ''"></p>
    </div>

    <div class="tab">Birthday:
    <p><input placeholder="dd" oninput="this.className = ''"></p>
    <p><input placeholder="mm" oninput="this.className = ''"></p>
    <p><input placeholder="yyyy" oninput="this.className = ''"></p>
    </div>

    <div class="tab">Login Info:
    <p><input placeholder="Username..." oninput="this.className = ''"></p>
    <p><input placeholder="Password..." oninput="this.className = ''"></p>
    </div>

    <div style="overflow:auto;">
    <div style="float:right;">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
    </div>

    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    </div>

    </form>
<!-- /.MultiStep Form -->
    </div>
</div>

@endsection

@push('js')

<script>
    
    var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
</script>
@endpush