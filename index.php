<?php
include 'header.php';
session_start();
if (isset($_SESSION['userId']) && isset($_SESSION['userName'])) {
  include 'db.php';
  $query = 'SELECT * FROM msgs';
  $result = mysqli_query($db, $query);
} else {
  header('location: login.php');
}
?>

<div class="bg-dark vh-100">
  <div class="container">
    <div class="header border-bottom border-secondary p-2 d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
        <img src="download.png" alt="" style="width: 60px;" class="me-3 rounded-circle">
        <div class="h4 text-white"><?= $_SESSION['userName'] ?></div>
      </div>
      <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <div class="card mt-3">
      <div class="card-header">
        <div class="h4">Chat Inbox</div>
      </div>
      <div class="card-body overflow-auto" style="min-height: 50vh; max-height: 400px;" id="chat-body">

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
          if ($row['userId'] == $_SESSION['userId']) {


        ?>
            <div class="d-flex justify-content-end mb-2">
              <div class="w-50 text-bg-light px-2 py-1 rounded">
                <p> <small class="border-bottom border-light"><?= $row['userName'] ?></small></p>
                <p><?= $row['message'] ?></p>
              </div>
            </div>

          <?php
          } else {

          ?>

            <div class="d-flex justify-content-start mb-2">
              <div class="w-50 text-bg-info px-2 py-1 rounded">
                <p> <small class="border-bottom border-light"><?= $row['userName'] ?></small></p>
                <p><?= $row['message'] ?></p>
              </div>
            </div>
        <?php
          }
        }
        ?>



      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-9">
            <input type="text" id="sendMsg" placeholder="write message here" class="form-control form-control-lg">
          </div>
          <div class="col-3">
            <div class="btn btn-primary w-100 h-100 fs-5 fw-bold" onclick="sendMsg()" id="sendBtn">Send</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php
include 'footer.php';
?>
<script>
  window.onload = () => {
    $("#chat-body").animate({
      scrollTop: $("#chat-body")[0].scrollHeight
    }, "slow");
  }

  function sendMsg() {
    input = $("#sendMsg").val();
    $("#sendBtn").html(`Sending <div class="spinner-border spinner-border-sm" role="status">
  <span class="visually-hidden">Loading...</span>
</div>`);
    if (input == '') {
      alert('input is empty!!');
      return 0;
    }
    $.ajax({
      url: "sendMsg.php",
      type: "POST",
      data: {
        url: 'sendMsg',
        userId: <?= $_SESSION['userId'] ?>,
        userName: '<?= $_SESSION['userName'] ?>',
        msg: input,
      },
      success: function(data) {
        input = $("#sendMsg").val('');
        $("#sendBtn").html('Send');
      },
      error: function(error) {
        $("#sendBtn").html('Send');
        alert(JSON.stringify(error));
      }
    })

  }

  userMsgId = <?= $_SESSION['userId'] ?>;
  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    if (userMsgId == data.id) {
      $('#chat-body').append(`<div class="d-flex justify-content-end mb-2">
              <div class="w-50 text-bg-success px-2 py-1 rounded">
                <p> <small class="border-bottom border-light">${data.name}</small></p>
                <p>${data.msg}</p>
              </div>
            </div>`)
    } else {
      $('#chat-body').append(`<div class="d-flex justify-content-start mb-2">
              <div class="w-50 text-bg-primary px-2 py-1 rounded">
                <p> <small class="border-bottom border-light">${data.name}</small></p>
                <p>${data.msg}</p>
              </div>
            </div>`)
    }
    $("#chat-body").animate({
      scrollTop: $("#chat-body")[0].scrollHeight
    }, "slow");
  });
</script>