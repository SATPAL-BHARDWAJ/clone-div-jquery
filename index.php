<?php

    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        die;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery clone an element and assign unique attributes</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="assets/css/font-awesome-4.7.0/css/font-awesome.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js" integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <div class="container">
        <form class="form-floating mt-5" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <div class="border p-3 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary m-2 add-new-js"> Add New </button> <button type="submit" class="btn btn-primary m-2"> Save </button>
            </div>
            <div class="group border p-3 section-group-js" data-index="0">
                <div class="d-flex justify-content-between align-items-center py-2 action-js">
                    <p class="m-0 text-black-50">Person Details : #<span class="sn-js">1</span></p> 
                    
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="details[0][name]" class="form-control" id="name_0" placeholder="Enter your name">
                    <label> Name </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="details[0][email]" class="form-control" id="email_0" placeholder="name@example.com">
                    <label>Email address</label>
                </div>
            </div>
            
        </form>
    </div>

    <script>
        $(document).on('click', '.add-new-js', function() {
           
            var form = $(this).closest('form');
            var section = form.find('.section-group-js:last-child');
            
            var index = section.data('index');
            var newIndex = index + 1;
            var newSection = section.clone();
            console.log(index, typeof index);

            newSection.find('input').val('');
            newSection.data('index', newIndex);
            newSection.attr('data-index', newIndex);
            newSection.find('.sn-js').text(newIndex + 1);

            if ( newSection.find('.remove-js').length === 0 ) {
                newSection.find('.action-js').append(`
                <button type="button" class="btn btn-danger remove-js"> <i class="fa fa-trash"></i> </button>
                `);
            }
            
            updateAttributes(newSection, 'name', index);
            updateAttributes(newSection, 'email', index);
            
            newSection.insertAfter(section);
           
        })

        $(document).on('click', '.remove-js', function() { 
            var section = $(this).closest('.section-group-js');
            section.remove();
        });

        function updateAttributes( newSection, key, index ) {
            var section = newSection.find(`[name="details[${index}][${key}]"]`);
            section.attr('name', `details[${index+1}][${key}]`);
            section.attr('id', `${key}_${index+1}`);
        }
    </script>
</body>

</html>