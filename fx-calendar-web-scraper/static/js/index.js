var taskId;
var uniqueId;
var statusInterval;

$(document).ready(function(){
    $(document).on('click', '#start-crawl', function(){
        $('#progress').attr("class", "alert alert-secondary");
        $('#progress').html('crawler is working...');
        $.ajax({
            url: '/api/crawl/',
            type: 'POST',
            data: {
            },
            success: crawlSuccess,
            error: crawlFail,
        })
    });

    $(document).on('click', '#show-data', function(){
        $.ajax({
            url: '/api/showdata/',
            type: 'GET',
            success: showData,
            error: showDataFail
        })
    });
});

function checkCrawlStatus(taskId, uniqueId){
    $.ajax({
        url: '/api/crawl/?task_id='+taskId+'&unique_id='+uniqueId+'/',
        type: 'GET',
        success: showCrawledData,
        error: showCrawledDataFail,
    })
}

function crawlSuccess(data){
    taskId = data.task_id;
    uniqueId = data.unique_id;
    statusInterval = setInterval(function() {checkCrawlStatus(taskId, uniqueId);}, 2000);
}

function crawlFail(data){
    $('#progress').html(data.responseJSON.error);
    $('#progress').attr("class", "alert alert-danger");
}

function showCrawledData(data){
    if (data.status){
        $('#progress').attr("class", "alert alert-secondary");
        $('#progress').html('crawler is ' + data.status + ' ... ' + 'After crawling, the results are returned');
    }else{
        clearInterval(statusInterval);
        $('#progress').attr("class", "alert alert-primary");
        $('#progress').html('crawling is finished!');
        var list = data.data;
        var html = '';
        for(var i=0; i<list.length; i++){
            html += `
            <tr>
                <th scope="row">`+ (i + 1) +`</th>
                <td width="20%">`+list[i].title+`</td>
                <td>`+ list[i].unique_id +`</td>
                <td>`+ list[i].ticker +`</td>
                <td>`+ list[i].symbol +`</td>
                <td>`+ list[i].date +`</td>
            </tr>
            `;
        }
        $('#board').html(html);
    }
}

function showCrawledDataFail(data){
    $('#progress').html(data.responseJSON.error);
    $('#progress').attr("class", "alert alert-danger");
}

function showData(data){
    var list = data.data;
    var html = '';
    for(var i=0; i<list.length; i++){
        html += `
            <tr>
                <th scope="row">`+ (i + 1) +`</th>
                <td width="20%">`+list[i].title+`</td>
                <td>`+ list[i].unique_id +`</td>
                <td>`+ list[i].ticker +`</td>
                <td>`+ list[i].symbol +`</td>
                <td>`+ list[i].date +`</td>
            </tr>
        `;
    }
    $('#progress').attr("class", "");
    $('#progress').empty();
    $('#board').html(html);
}

function showDataFail(data){
    $('#progress').attr("class", "alert alert-danger");
    $('#progress').html(data.responseJSON.error);
    $('#board').empty();
}