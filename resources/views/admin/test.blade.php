<!DOCTYPE html>
<html>
<head>
    <title>Cascading Dropdown</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Select Category & View Foods</h2>

<select id="parent_category">
    <option value="">-- Select Parent Category --</option>
    @foreach ($parents as $parent)
        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
    @endforeach
</select>

<select id="child_category" disabled>
    <option value="">-- Select Child Category --</option>
</select>

<div id="foods_list">
    <!-- Food items will appear here -->
</div>

<script>
    $('#parent_category').on('change', function () {
        let parentId = $(this).val();
        $('#child_category').html('<option value="">Loading...</option>');

        if (parentId) {
            $.get(`/category/${parentId}/children`, function (data) {
                let options = '<option value="">-- Select Child Category --</option>';
                data.forEach(function (category) {
                    options += `<option value="${category.id}">${category.name}</option>`;
                });
                $('#child_category').html(options).prop('disabled', false);
            });
        } else {
            $('#child_category').html('<option value="">-- Select Child Category --</option>').prop('disabled', true);
            $('#foods_list').html('');
        }
    });

    $('#child_category').on('change', function () {
        let childId = $(this).val();
        if (childId) {
            $.get(`/category/${childId}/foods`, function (foods) {
                let html = '<ul>';
                foods.forEach(function (food) {
                    html += `<li>${food.name} - $${food.price}</li>`;
                });
                html += '</ul>';
                $('#foods_list').html(html);
            });
        } else {
            $('#foods_list').html('');
        }
    });
</script>

</body>
</html>
