jQuery(document).ready(function($) {
    var offset = 0;
    var limit = 100;
    
    // Call the AJAX function to perform the batch job
    function performBatchJob() {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'my_ajax_batch_job',
                offset: offset,
                limit: limit
            },
            success: function(data) {
                // Process the batch job results
                if (data.length > 0) {
                    // Do something with the results (e.g. display them on the page)
                    console.log(data);
                    
                    // Increment the offset for the next batch
                    offset += limit;
                    
                    // Call the function again to perform the next batch
                    performBatchJob();
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
            }
        });
    }
    
    // Start the batch job
    performBatchJob();
});
