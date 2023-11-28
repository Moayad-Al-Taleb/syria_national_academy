<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/forms.css">

</head>

<body>
    <header>
        <div class="logo">
            s.n.a
        </div>
        <div class="admin-info">
            <span>welcome kareem</span>
            <a href="#">logout</a>
        </div>
    </header>
    <div class="container">
        <h2>enter course details</h2>
        <form action="">
            <div class="row">
                <div class="input-field">
                    <label for="">title</label>
                    <input type="text">
                </div>
                <div class="input-field">
                    <label for="">teacher name:</label>
                    <input type="text">
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <label for="">price</label>
                    <input type="number" name="" value="">
                </div>
                <div class="text-field">
                    <label for="">details</label>
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                </div>

            </div>
            <div class="row">
                <div class="input-field">
                    <label for="">sessions numbers</label>
                    <input type="number" name="" value="">
                </div>
                <div class="input-field">
                    <label for="">image</label>
                    <input type="file" name="" value="">
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <label for="">start date</label>
                    <input type="date" name="" value="">
                </div>
                <div class="input-field">
                    <label for="">end date</label>
                    <input type="date" name="" value="">
                </div>
            </div>
            <div class="row">
                <input class="add-btn" type="submit" value="add course">
            </div>
        </form>
    </div>
</body>

</html>