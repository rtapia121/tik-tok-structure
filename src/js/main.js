const videos = document.querySelectorAll('video');
for (const video of videos) {
    video.addEventListener('click', function () {
        if (video.paused) {
            video.play();
            video.muted = false;
        } else {
            video.pause();
        }
    });
}

const media = document.querySelectorAll('video');
const divVideos = document.querySelectorAll('div.video');
document.getElementById("videos").addEventListener('scroll',function(e){
    media.forEach(video =>{
        console.log(video.scrollTop);
        video.muted = true;
     });
});


// // window.addEventListener('scroll',videoScroll);


    // divVideos.forEach(item => {
    //     console.log(item.scrollTop);
    //     video.muted = true;
    // });
// // function videoScroll() {
// //     debugger;
// //   var media = document.querySelectorAll('video');
// //   if(media.length >0 ){
// //       windowHeight = window.innerHeight;
// //       video = document.querySelectorAll('video[autoplay]');

// //       for (var i = 0; i < video.length; i++) {

// //         var thisVideoEl = video[i],
// //             videoHeight = thisVideoEl.clientHeight,
// //             videoClientRect = thisVideoEl.getBoundingClientRect().top;
  
// //         if ( videoClientRect <= ( (windowHeight) - (videoHeight*.5) ) && videoClientRect >= ( 0 - ( videoHeight*.5 ) ) ) {
// //           thisVideoEl.play();
// //         } else {
// //           thisVideoEl.pause();
// //         }
  
// //       }
// //   }  
// // }