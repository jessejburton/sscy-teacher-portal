(function($){
    $(function(){

        // Show Registrants when class is selected
        $("#class_select").on("change", function(){
            $("#registration").toggle($(this).val().length > 0);
        });

        // Show Report when date is selected
        $("#to").on("change", function(){
            $("#report").toggle($(this).val().length > 0);
        });

        // When Month is selected 
        $("#month_select").on("change", function(){
            var startDate = $(this).val();

            if(startDate.length > 1){
                $("#from").val(startDate);
                $("#to").val(startDate).trigger("change");
            } else {
                $("#from").val("");
                $("#to").val("");
                $("#report").hide();
            }
        });

        $(document).on("click", ".registration-checkin", function(){
            $(this).replaceWith('<span class="checkedin" title="Click to un-check in">checked in</span>');
        });

        $(document).on("click", ".checkedin", function(){
            $(this).replaceWith('<button class="button registration-checkin">CHECK IN</button>');
        });

        $(".registration-new").on('click', function(){
            var r = $("#registrant-table").find(".template").clone(false);

            r.removeClass("template");
            r.find(".registrant-name").html($("#registrant_name").val());
            r.find(".registrant-email").html($("#registrant_email").val());
            r.find(".registrant-pr").prop("checked", $("#registrant_pr").is(":checked"));
            r.find(".registrant-ky").prop("checked", $("#registrant_ky").is(":checked"));

            $("#registrant-table").find("tbody").append(r);

            // Clear the values
            $("#registrant_name").val("");
            $("#registrant_email").val("");
            $("#registrant_pr").prop("checked", false);
            $("#registrant_ky").prop("checked", false);
        });

        // Edit Class
        $(document).on("click", ".edit-class", function(){
            showModal("<h3>Edit Class</h3><div class='row'><label class='input-textarea-label'>class name</label><input type='text' class='input-text' placeholder='class name' value='Hatha Mixed Levels with John' /></div><div class='row'><label class='input-textarea-label'>class description</label><textarea class='input-textarea' placeholder='class description' rows='15'>A balanced combination of sustained poses with attention to basic alignment and therapeutic principals. Mindfulness; observing breath and body (triputi) are an integral part of class. This style of yoga provides a great stretch and strengthens the body.</textarea></div>");
        });

        // Cancel Class
        $(document).on("click", ".cancel-class", function(){
            showModal("<p><strong>Are you sure you would like to cancel the following class:</strong></p><p>Monday, April 23rd - Hatha Mixed Levels with John</p>");
        });

        // Send Report
        $(document).on("click", ".send-report", function(){
            showModal("<p><strong>Are you sure you would like to send this report to the Yoga Centre?</strong></p>");
        });

        $(".modal-content-buttons").on("click", function(){
            $(".modal-overlay").fadeOut("fast");
        });

        if($(".show").length > 0){
            $("#class_select").val("2").trigger("change");
        }

        var dateFormat = "mm/dd/yy",
            // From Date Picker
            from = $( "#from" ).datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3
                })
                .on( "change", function() {
                    to.datepicker( "option", "minDate", getDate( this ) );
                }),
            // To Date Picker
            to = $( "#to" ).datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3
                })
                .on( "change", function() {
                    from.datepicker( "option", "maxDate", getDate( this ) );
                });
   
        function getDate( element ) {
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
                date = null;
            }

            return date;
        }

        function showModal(html){
            $(".modal-content-body").html(html);
            $(".modal-overlay").fadeIn("fast");
        }

    }); // end of document ready
})(jQuery); // end of jQuery name space