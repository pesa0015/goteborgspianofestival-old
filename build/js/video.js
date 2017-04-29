var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var player;
function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    height: '390',
    width: '640',
    videoId: 'aX22f-sUXd4',
    events: {
      'onReady': onPlayerReady,
      'onStateChange': onPlayerStateChange
    }
  });
}
function onPlayerReady(event) {
  return false;
}
function onPlayerStateChange(event) {
  return false;
}
var video = document.getElementById('video');
$(video).click(function(){
  $('.flexslider').pause();
});
var videoModal = document.getElementById('modal-video');
document.getElementById('video-icon').onclick = function() {
  showModal(videoModal, true, true, false, true);
}
