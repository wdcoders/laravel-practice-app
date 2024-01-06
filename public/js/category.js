$(document).on("submit", "#categoryDetailsForm", function (e) {
    e.preventDefault();

    var category_id = $("#category_id").val();
    var title = $("#title").val();
    var status = $("#status").prop("checked") ? 1 : 0;

    var category = {
        title: title,
        status: status,
    };

    if (category_id === "") {
        storeCategory(category);
    } else {
        updateCategory(category, category_id);
    }
});

// edit event
$(document).on("click", ".edit-category", function (e) {
    e.preventDefault();
    var category_id = $(this).attr("data-id");
    loadCategory(category_id);
});

// delete event
$(document).on("click", ".delete-category", function (e) {
    e.preventDefault();
    var category_id = $(this).attr("data-id");
    if (confirm("Are you sure?")) {
        deleteCategory(category_id);
    }
});

function gatAllCategory() {
    $.ajax({
        url: "http://localhost:8000/category/fetch-all",
        method: "GET",
        success: function (response) {
            $("#category-data").html("");
            response.data.forEach((e) => {
                var status = e.status
                    ? `<span class="badge text-bg-success">Active</span>`
                    : `<span class="badge text-bg-danger">Inactive</span>`;

                $("#category-data").append(`
                <tr>
                    <th>${e.id}</th>
                    <td>${e.title}</td>
                    <td>${status}</td>
                    <td>
                        <button class="btn btn-sm btn-success edit-category" data-id="${e.id}">Edit</button>
                        <button class="btn btn-sm btn-danger delete-category" data-id="${e.id}">Delete</button>
                    </td>
                </tr>
                `);
            });
        },
    });
}

function storeCategory(data) {
    $.ajax({
        url: "http://localhost:8000/category",
        method: "POST",
        data: data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            if (response.status) {
                alert(response.message);
                gatAllCategory();
                resetAllFields();
                $("#categoryDetail").offcanvas("hide");
            } else {
                errorMessage(response.error);
            }
        },
    });
}

function updateCategory(data, id) {
    $.ajax({
        url: `http://localhost:8000/category/${id}/update`,
        method: "POST",
        data: data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            if (response.status) {
                alert(response.message);
                gatAllCategory();
                resetAllFields();
                $("#categoryDetail").offcanvas("hide");
            } else {
                errorMessage(response.error);
            }
        },
    });
}

function deleteCategory(id) {
    $.ajax({
        url: `http://localhost:8000/category/${id}/delete`,
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            gatAllCategory();
        },
    });
}

function loadCategory(id) {
    $.ajax({
        url: `http://localhost:8000/category/${id}/show`,
        method: "GET",
        success: function (response) {
            $("#title").val(response.data.title);
            if (response.data.status) {
                $("#status").prop("checked", true);
            }
            $("#category_id").val(response.data.id);
            $("#categoryDetail").offcanvas("show");
        },
    });
}

function resetAllFields() {
    $("#title").val("");
    $("#status").prop("checked", false);
    $("#category_id").val("");
}

function errorMessage(error) {
    var fieldNames = Object.keys(error);
    var fieldErrors = Object.values(error);
    for (let index = 0; index < fieldNames.length; index++) {
        $("#" + fieldNames[index]).after(
            `<span class='field-error text-danger'>${fieldErrors[index]}</span>`
        );
    }
}
