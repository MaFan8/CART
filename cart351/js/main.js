window.onload = function() {

let exercises = document.getElementById('exercises');
let presentation = document.getElementById('presentation');
let reflections = document.getElementById('reflections');
let project = document.getElementById('project');
let clickCount =0;

// CLICK FUNCTION
document.getElementById('exercises').addEventListener('click', function() {
  if(clickCount%2==0){
  presentation.style.visibility = "hidden";
  reflections.style.visibility = "hidden";
  project.style.visibility = "hidden";
  //unhide lists
  document.getElementById('ex_links').style.display = "block";
}
else{
  presentation.style.visibility = "visible";
  reflections.style.visibility = "visible";
  project.style.visibility = "visible";
  //unhide lists
  document.getElementById('ex_links').style.display = "none";
}
  clickCount = clickCount+1;
  //show dots
  // document.getElementsByClassName('dots').style.display = "block";
  document.querySelectorAll('span.dots').style.display = "block";
}); // END CLICK FUNCTION

// CLICK FUNCTION
document.getElementById('presentation').addEventListener('click', function() {
  if (clickCount%2==0) {
  exercises.style.visibility = "hidden";
  reflections.style.visibility = "hidden";
  project.style.visibility = "hidden";
  //unhide lists
  // document.getElementById('slides_link').style.display = "block";
  document.getElementById('presentation_links').style.display = "block";
}
else {
  exercises.style.visibility = "visible";
  reflections.style.visibility = "visible";
  project.style.visibility = "visible";
  //unhide lists
  // document.getElementById('slides_link').style.display = "block";
  document.getElementById('presentation_links').style.display = "none";
}
  clickCount = clickCount+1;
  //show dots
  // document.getElementById('dots').style.display = "block";
});// END CLICK FUNCTION
//
// document.getElementById('reflections').addEventListener('click', function() {
//   presentation.style.visibility = "hidden";
//   exercises.style.visibility = "hidden";
//   project.style.visibility = "hidden";
//   //remove hover in css
//   reflections.style.pointerEvents = "none";
//   //unhide lists
//   document.getElementById('ref_links1').style.display = "block";
//   document.getElementById('ref_links2').style.display = "block";
// });
//
document.getElementById('project').addEventListener('click', function() {
  if (clickCount%2==0) {
  exercises.style.visibility = "hidden";
  reflections.style.visibility = "hidden";
  presentation.style.visibility = "hidden";
  //unhide lists
  document.getElementById('proposal_link').style.display = "block";
}
else {
  exercises.style.visibility = "visible";
  reflections.style.visibility = "visible";
  presentation.style.visibility = "visible";
  //unhide lists
  // document.getElementById('slides_link').style.display = "block";
  document.getElementById('proposal_link').style.display = "none";
}
  clickCount = clickCount+1;

});


}
