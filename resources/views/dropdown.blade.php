<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>



    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-3">
                <div class="mb-3">
                    <label for="" class="form-label">Country</label>
                    <select name="" id="country" class="form-select">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">State</label>
                    <select name="" id="state" class="form-select">
                        <option value="">Select State</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">City</label>
                    <select name="" id="city" class="form-select">
                        <option value="">Select City</option>
                    </select>
                </div>
            </div>
        </div>
    </div>






    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).on("change", "#country", function() {
            var country_id = $(this).val();
            $("#city").html("<option>Select City</option>")

            $.ajax({
                url: 'http://localhost:8000/state/' + country_id,
                method: "GET",
                success: function(response) {
                    $("#state").html("<option>Select State</option>")
                    response.data.forEach(e => {
                        $("#state").append(`<option value="${e.id}">${e.name}</option>`)
                    });
                }
            })
        })

        $(document).on("change", "#state", function() {
            var state_id = $(this).val();

            $.ajax({
                url: 'http://localhost:8000/city/' + state_id,
                method: "GET",
                success: function(response) {
                    $("#city").html("<option>Select City</option>")
                    response.data.forEach(e => {
                        $("#city").append(`<option value="${e.id}">${e.name}</option>`)
                    });
                }
            })
        })
    </script>
</body>
</body>

</html>
