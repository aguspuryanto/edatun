<!-- Page Heading -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?=@$title; ?></h1>
</div> -->
<style>.card-bordered {
    border: 1px solid #ebebeb;
}

.card {
    border: 0;
    border-radius: 0px;
    margin-bottom: 30px;
    -webkit-box-shadow: 0 2px 3px rgba(0,0,0,0.03);
    box-shadow: 0 2px 3px rgba(0,0,0,0.03);
    -webkit-transition: .5s;
    transition: .5s;
}

.padding {
    padding: 3rem !important
}

body {
    background-color: #f9f9fa
}

.card-header:first-child {
    border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
}


.card-header {
    display: -webkit-box;
    display: flex;
    -webkit-box-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    align-items: center;
    padding: 15px 20px;
    background-color: transparent;
    border-bottom: 1px solid rgba(77,82,89,0.07);
}

.card-header .card-title {
    padding: 0;
    border: none;
}

h4.card-title {
    font-size: 17px;
}

.card-header>*:last-child {
    margin-right: 0;
}

.card-header>* {
    margin-left: 8px;
    margin-right: 8px;
}

.btn-secondary {
    color: #4d5259 !important;
    background-color: #e4e7ea;
    border-color: #e4e7ea;
    color: #fff;
}

.btn-xs {
    font-size: 11px;
    padding: 2px 8px;
    line-height: 18px;
}
.btn-xs:hover{
    color:#fff !important;
}

.card-title {
    font-family: Roboto,sans-serif;
    font-weight: 300;
    line-height: 1.5;
    margin-bottom: 0;
    padding: 15px 20px;
    border-bottom: 1px solid rgba(77,82,89,0.07);
}


.ps-container {
    position: relative;
}

.ps-container {
    -ms-touch-action: auto;
    touch-action: auto;
    overflow: hidden!important;
    -ms-overflow-style: none;
}

.media-chat {
    padding-right: 64px;
    margin-bottom: 0;
}

.media {
    padding: 16px 12px;
    -webkit-transition: background-color .2s linear;
    transition: background-color .2s linear;
}

.media .avatar {
    flex-shrink: 0;
}

.avatar {
    position: relative;
    display: inline-block;
    width: 36px;
    height: 36px;
    line-height: 36px;
    text-align: center;
    border-radius: 100%;
    background-color: #f5f6f7;
    color: #8b95a5;
    text-transform: uppercase;
}

.media-chat .media-body {
    -webkit-box-flex: initial;
    flex: initial;
    display: table;
}

.media-body {
    min-width: 0;
}

.media-chat .media-body p {
    position: relative;
    padding: 6px 8px;
    margin: 4px 0;
    background-color: #f5f6f7;
    border-radius: 3px;
    font-weight: 100;
    color:#9b9b9b;
}

.media>* {
    margin: 0 8px;
}

.media-chat .media-body p.meta {
    background-color: transparent !important;
    padding: 0;
    opacity: .8;
}

.media-meta-day {
    -webkit-box-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    align-items: center;
    margin-bottom: 0;
    color: #8b95a5;
    opacity: .8;
    font-weight: 400;
}

.media {
    padding: 16px 12px;
    -webkit-transition: background-color .2s linear;
    transition: background-color .2s linear;
}

.media-meta-day::before {
    margin-right: 16px;
}

.media-meta-day::before, .media-meta-day::after {
    content: '';
    -webkit-box-flex: 1;
    flex: 1 1;
    border-top: 1px solid #ebebeb;
}

.media-meta-day::after {
    content: '';
    -webkit-box-flex: 1;
    flex: 1 1;
    border-top: 1px solid #ebebeb;
}

.media-meta-day::after {
    margin-left: 16px;
}

.media-chat.media-chat-reverse {
    padding-right: 12px;
    padding-left: 64px;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: reverse;
    flex-direction: row-reverse;
}

.media-chat {
    padding-right: 64px;
    margin-bottom: 0;
}

.media {
    padding: 16px 12px;
    -webkit-transition: background-color .2s linear;
    transition: background-color .2s linear;
}

.media-chat.media-chat-reverse .media-body p {
    float: right;
    clear: right;
    background-color: #48b0f7;
    color: #fff;
}

.media-chat.media-chat-reverse .media-body p.meta {
    color: #9b9b9b;
}

.media-chat .media-body p {
    position: relative;
    padding: 6px 8px;
    margin: 4px 0;
    background-color: #f5f6f7;
    border-radius: 3px;
}


.border-light {
    border-color: #f1f2f3 !important;
}

.bt-1 {
    border-top: 1px solid #ebebeb !important;
}

.publisher {
    position: relative;
    display: -webkit-box;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    padding: 12px 20px;
    background-color: #f9fafb;
}

.publisher>*:first-child {
    margin-left: 0;
}

.publisher>* {
    margin: 0 8px;
}

.publisher-input {
    -webkit-box-flex: 1;
    flex-grow: 1;
    border: none;
    outline: none !important;
    background-color: transparent;
}

button, input, optgroup, select, textarea {
    font-family: Roboto,sans-serif;
    font-weight: 300;
}

.publisher-btn {
    background-color: transparent;
    border: none;
    color: #8b95a5;
    font-size: 16px;
    cursor: pointer;
    overflow: -moz-hidden-unscrollable;
    -webkit-transition: .2s linear;
    transition: .2s linear;
}

.file-group {
    position: relative;
    overflow: hidden;
} 

.publisher-btn {
    background-color: transparent;
    border: none;
    color: #cac7c7;
    font-size: 16px;
    cursor: pointer;
    overflow: -moz-hidden-unscrollable;
    -webkit-transition: .2s linear;
    transition: .2s linear;
} 

.file-group input[type="file"] {
    position: absolute;
    opacity: 0;
    z-index: -1; 
    width: 20px;
}

.text-info {
    color: #48b0f7 !important;
}

.modal {
    width: auto;
    height: auto;
    top: auto;
    left: auto;
    bottom: 0;
    right: 0;
    margin: 0;
}
</style>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h6 class="mb-4">Apa itu <?=@$title; ?>?</h6>
                        <p class="font-weight-bold mb-4"><?=@$desc; ?></p>
                        <a href="create_ph?type=<?=@$title; ?>" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Submit <?=@$title; ?></span>
                        </a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <?=get_header_table_custom($model, ['jenis_permohonan', 'status'], '<th>Aksi</th>');?>
                        </thead>
                        <tbody>
                        <?php
                        if($listData) : 
                            $id=1;
                            foreach($listData as $row) {
                                // echo $row->dokumen;
                                $dokUrl = '';
                                $isArray = json_decode($row->dokumen, true); //explode(",", $row->dokumen);                                
                                if(is_array($isArray)) {
                                    foreach($isArray as $key => $dok) {
                                        $dokUrl .= '<a target="_blank" href="'.base_url('permohonan/dokumen/' . $dok).'">Dokumen ' . ($key+1) . '</a> ';
                                    }
                                    // $dokUrl = implode(', ', $doklink);
                                    // $dokUrl = rtrim($dokUrl, ',');
                                } else {
                                    $dokUrl = ($row->dokumen) ? '<a target="_blank" href="'.base_url('permohonan/dokumen/' . $row->dokumen).'">Dokumen</a>' : '#';
                                }

                                echo '<tr>
                                    <td>'.$id.'</td>
                                    <td>'.$row->pemohon.'</td>
                                    <td>'.$row->termohon.'</td>
                                    <td>'.date('d-m-Y', strtotime($row->tgl_permohonan)).'</td>
                                    <td>'.$row->no_registrasi.'</td>
                                    <td>'.$row->subject.'</td>
                                    <td>'.$row->kasus_posisi.'</td>
                                    <td>'.$dokUrl.'</td>
                                    <td><div class="btn-group" role="group">
                                        <a href="' . base_url('permohonan/edit_ph?type=Konsiliasi&row_id='.$row->id) . '" data-id="'.$row->id.'" class="btn btn-secondary btnEdit">Edit</a>
                                        <button type="button" data-id="'.$row->id.'" class="btn btn-danger btnRemove">Hapus</button>
                                        <button type="button" data-id="'.$row->id.'" class="btn btn-info btnChat" data-toggle="modal" data-target="#exampleModal">Chat</button>
                                    </div></td>
                                </tr>';
                                $id++;
                            }
                        endif;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog xposition-fixed end-0" role="document">
    <div class="modal-content xposition-absolute bottom-0">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chat</h5>
        <!-- <button type="button" class="btn btn-primary btn-sm">Let's Chat App</button> -->
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body" style="position: relative; height: 420px">
        <div class="card card-bordered">
            <?=form_hidden('type', $title); ?>
            <?=form_hidden('row_id', ''); ?>
            <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:400px !important;">
                <!-- <div class="media media-chat">
                  <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                  <div class="media-body">
                    <p>Hi</p>
                    <p>How are you ...???</p>
                    <p>What are you doing tomorrow?<br> Can we come up a bar?</p>
                    <p class="meta"><time datetime="2018">23:58</time></p>
                  </div>
                </div>

                <div class="media media-meta-day">Today</div>

                <div class="media media-chat media-chat-reverse">
                  <div class="media-body">
                    <p>Hiii, I'm good.</p>
                    <p>How are you doing?</p>
                    <p>Long time no see! Tomorrow office. will be free on sunday.</p>
                    <p class="meta"><time datetime="2018">00:06</time></p>
                  </div>
                </div>

                <div class="media media-chat">
                  <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                  <div class="media-body">
                    <p>Okay</p>
                    <p>We will go on sunday? </p>
                    <p class="meta"><time datetime="2018">00:07</time></p>
                  </div>
                </div>

                <div class="media media-chat media-chat-reverse">
                  <div class="media-body">
                    <p>That's awesome!</p>
                    <p>I will meet you Sandon Square sharp at 10 AM</p>
                    <p>Is that okay?</p>
                    <p class="meta"><time datetime="2018">00:09</time></p>
                  </div>
                </div>

                <div class="media media-chat">
                  <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                  <div class="media-body">
                    <p>Okay i will meet you on Sandon Square </p>
                    <p class="meta"><time datetime="2018">00:10</time></p>
                  </div>
                </div>

                <div class="media media-chat media-chat-reverse">
                  <div class="media-body">
                    <p>Do you have pictures of Matley Marriage?</p>
                    <p class="meta"><time datetime="2018">00:10</time></p>
                  </div>
                </div>

                <div class="media media-chat">
                  <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                  <div class="media-body">
                    <p>Sorry I don't have. i changed my phone.</p>
                    <p class="meta"><time datetime="2018">00:12</time></p>
                  </div>
                </div>

                <div class="media media-chat media-chat-reverse">
                  <div class="media-body">
                    <p>Okay then see you on sunday!!</p>
                    <p class="meta"><time datetime="2018">00:12</time></p>
                  </div>
                </div> -->

              <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div></div></div>

            </div>
      </div>
      <div class="modal-footer" style="display: block; padding:0em;">
        <div class="publisher bt-1 border-light">
            <input class="publisher-input" type="text" placeholder="Write something">
            <!-- <span class="publisher-btn file-group">
                <i class="fa fa-paperclip file-browser"></i>
                <input type="file">
            </span>
            <a class="publisher-btn" href="#" data-abc="true"><i class="fa fa-smile"></i></a> -->
            <a class="publisher-btn text-info" href="#" data-abc="true"><i class="fa fa-paper-plane"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
// $Urladd = base_url('permohonan/create');
$Urldetail = base_url('permohonan/view_konsiliasi');
$Urlremove = base_url('permohonan/remove_konsiliasi');
?>

<script type="text/javascript">
$( document ).ready(function() {
    // $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $(".datepicker").datepicker({
      format:'dd/mm/yyyy',
    }).datepicker("setDate",'now');

    var table = $('#dataTable').DataTable();

    $(document).on('click', '.btnRemove', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        if (confirm("Apakah anda yakin ingin menghapus data ini?")==true){
            // $(this).closest("tr").remove();
            table.row( $(this).parents('tr') ).remove().draw();
            $.post("<?=$Urlremove;?>/", {id: dataId}, function(result){
                console.log(result, "_result");
            });
        };
    });

    $(document).on('click', '.btnChat', function (e){
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        $('#exampleModal').find('input[name=row_id]').val(dataId);

        update_chats();
    });

    $(document).on('shown.bs.modal', '#exampleModal', function (e) {
        console.log($(e.relatedTarget.id));
        // update_chats();
    });

    $(document).on('click', 'a.publisher-btn', function (e){
        e.preventDefault();
        var textmsg = $('input.publisher-input').val();
        console.log(textmsg, '_textmsg');

        var chatdata = {
            textmsg: textmsg,
            // type: 'Konsiliasi',
            sender_id: '<?= $this->session->userdata('id') ?>',
            row_id: $('#exampleModal').find('input[name=row_id]').val(),
        }
        sendChat(chatdata, function (e){
            // console.log(data, '_data');
            $('input.publisher-input').val('');
            update_chats();
        });
    });
    
    $('input.publisher-input').keyup(function (e) {
        if (e.which == 13) {
            $('a.publisher-btn').trigger('click');
        }
    });
    
    var sendChat = function (data, callback) {
        console.log(data, '_data');
        // var guid = getCookie('user_guid');
        $.getJSON('<?= base_url('Api'); ?>/api/send_message?message=' + data.textmsg + '&sender_id=' + data.sender_id + '&row_id=' + data.row_id, function (data){
            callback(data);
        });
    }

    var append_chat_data = function (chat_data) {
        $("#chat-content").html('');
        chat_data.forEach(function (data) {
            const now = new Date(data.created_at);
            const hoursAndMinutes = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
            });

            var is_me = '<?= $this->session->userdata('id') ?>';
            if(data.sender_id == is_me){
                var html = '<div class="media media-chat media-chat-reverse">' +
                    '<div class="media-body" data-jam="' + now.getHours() + '">' +
                    '<p>' + data.msg + '</p>' +
                    '<p class="meta"><time datetime="' + now.getFullYear() + '">' + hoursAndMinutes + '</time></p>' +
                    '</div>' +
                '</div>';
            } else {
                var html = '<div class="media media-chat">' +
                    '<img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">' +
                    '<div class="media-body" data-jam="' + now.getHours() + '">' +
                    '<p>' + data.msg + '</p>' +
                    '<p class="meta"><time datetime="' + now.getFullYear() + '">' + hoursAndMinutes + '</time></p>' +
                    '</div>' +
                '</div>';
            }

            $("#chat-content").html($("#chat-content").html() + html);
            $('#chat-content').scrollTop($('#chat-content')[0].scrollHeight);
        });
    }

    var update_chats = function () {
        if(typeof(request_timestamp) == 'undefined' || request_timestamp == 0){
            var offset = 60*15; // 15min
            request_timestamp = parseInt( Date.now() / 1000 - offset );
        }
        
        var sender_id = '<?= $this->session->userdata('id') ?>';
        var row_id = $('#exampleModal').find('input[name=row_id]').val();
        $.getJSON('<?= base_url('Api'); ?>/api/get_messages?sender_id=' + sender_id + '&row_id=' + row_id, function (data){
            append_chat_data(data);	
        });
    }

    // setInterval(function (){
    //     update_chats();
    // }, 5000);
});
</script>