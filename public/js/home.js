$(document).ready(function () {
    $("#dashboradheader").on("click", function (e) {
        adopted();
        rescued();
        function adopted() {
            var datas = {
                from: $("#adoptedchart1").val(),
                to: $("#adoptedchart2").val(),
            };
            $.ajax({
                type: "GET",
                url: "/api/adoptedchart",
                data: datas,

                success: function (response) {
                    console.log(response);
                    console.log(response.data);

                    var labels = response.data.map(function (e) {
                        return e.month;
                    });

                    var data = response.data.map(function (e) {
                        return e.totalid;
                    });

                    var ctx = $("#myChart");
                    var config = {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: "Adopted Animal",
                                    data: data,
                                    backgroundColor: poolColors(data.length),
                                    borderColor: poolColors(data.length),
                                    borderWidth: 2,
                                },
                            ],
                        },
                        options: {
                            scales: {
                                yAxes: [
                                    {
                                        ticks: {
                                            beginAtZero: true,
                                        },
                                    },
                                ],
                            },
                        },
                    };
                    var chart = new Chart(ctx, config);
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON);
                },
            });
        }

        function dynamicColors() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgba(" + r + "," + g + "," + b + ", 0.5)";
        }

        function poolColors(a) {
            var pool = [];
            for (i = 0; i < a; i++) {
                pool.push(dynamicColors());
            }
            return pool;
        }

        function rescued() {
            var datass = {
                from: $("#adoptedchart3").val(),
                to: $("#adoptedchart4").val(),
            };
            $.ajax({
                type: "GET",
                url: "/api/adoptedchartupdate",
                data: datass,

                success: function (response) {
                    console.log(response);
                    console.log(response.data);

                    var labels = response.data.map(function (e) {
                        return e.month;
                    });

                    var data = response.data.map(function (e) {
                        return e.totalid;
                    });

                    var ctx = $("#myChart2");
                    var config = {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: "Rescued Animal",
                                    data: data,
                                    backgroundColor: poolColors(data.length),
                                    borderColor: poolColors(data.length),
                                    borderWidth: 2,
                                },
                            ],
                        },
                        options: {
                            scales: {
                                yAxes: [
                                    {
                                        ticks: {
                                            beginAtZero: true,
                                        },
                                    },
                                ],
                            },
                        },
                    };
                    var chart = new Chart(ctx, config);
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON);
                },
            });
        }

        var date_input = document.getElementById("adoptedchart1");
        var date_input2 = document.getElementById("adoptedchart2");
        var date_input3 = document.getElementById("adoptedchart3");
        var date_input4 = document.getElementById("adoptedchart4");

        date_input.onchange = function () {
            adopted();
        };

        date_input2.onchange = function () {
            adopted();
        };

        date_input3.onchange = function () {
            rescued();
        };

        date_input4.onchange = function () {
            rescued();
        };
    });

    $("#adoptedmodal").on("show.bs.modal", function (e) {
        $.ajax({
            type: "GET",
            url: "/api/adoptedindex/",
            success: function (data) {
                console.log(data);

                $.each(data.data, function (key, value) {
                    // console.log(value.image);
                    $("#galleryimageadopted").prepend(
                        "<a href=" +
                            value.image +
                            "><img src=" +
                            value.animalimage +
                            "/> " +
                            value.animal_name +
                            "</a>  <p>" +
                            value.fname +
                            " " +
                            value.lname +
                            "</p>"
                    );
                });

                $("#galleryimageadopted a").click(function (evt) {
                    //don't follow link
                    evt.preventDefault();
                    var imgPath = $(this).attr("href");
                    var oldImage = $("#galleryphotoadopted img");

                    var newImage = $("<img src=" + imgPath + "/>");
                    newImage.hide();

                    $("#galleryphotoadopted").prepend(newImage);
                    newImage.fadeIn(1000);

                    oldImage.fadeOut(1000, function () {
                        $(this).remove();
                    });
                });
            },
            error: function () {
                console.log("AJAX load did not work");
                alert("error");
            },
        });
    });
}); //end ready
