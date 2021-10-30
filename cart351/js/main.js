window.onload = function() {

let exercises = document.getElementById('exercises');
let presentation = document.getElementById('presentation');
let reflections = document.getElementById('reflections');
let project = document.getElementById('project');
let clickCount =0;

// CLICK EXERCIESE
document.getElementById('exercises').addEventListener('click', function() {
  if(clickCount%2==0){
  presentation.style.visibility = "hidden";
  reflections.style.visibility = "hidden";
  project.style.visibility = "hidden";
  //unhide lists
  document.getElementById('ex_grid_pos').style.display = "block";
}
else{
  presentation.style.visibility = "visible";
  reflections.style.visibility = "visible";
  project.style.visibility = "visible";
  //unhide lists
  document.getElementById('ex_grid_pos').style.display = "none";
}
  clickCount = clickCount+1;
  //show dots
  // document.getElementsByClassName('dots').style.display = "block";
  document.querySelectorAll('span.dots').style.display = "block";
}); // END CLICK

// CLICK PRESENTATION
document.getElementById('presentation').addEventListener('click', function() {
  if (clickCount%2==0) {
  exercises.style.visibility = "hidden";
  reflections.style.visibility = "hidden";
  project.style.visibility = "hidden";
  //unhide lists
  document.getElementById('slides_box').style.display = "block";
  document.getElementById('pres_box').style.display = "block";
}
else {
  exercises.style.visibility = "visible";
  reflections.style.visibility = "visible";
  project.style.visibility = "visible";
  //unhide lists
  document.getElementById('slides_box').style.display = "none";
  document.getElementById('pres_box').style.display = "none";
}
  clickCount = clickCount+1;
  //show dots
  // document.getElementById('dots').style.display = "block";
});// END CLICK

// CLICK REFLECTION
document.getElementById('reflections').addEventListener('click', function() {
  if (clickCount%2==0) {
  exercises.style.visibility = "hidden";
  presentation.style.visibility = "hidden";
  project.style.visibility = "hidden";
  //unhide lists
  document.getElementById('ref_grid1').style.display = "block";
  document.getElementById('ref_grid2').style.display = "block";
}
else {
  exercises.style.visibility = "visible";
  presentation.style.visibility = "visible";
  project.style.visibility = "visible";
  //unhide lists
  document.getElementById('ref_grid1').style.display = "none";
  document.getElementById('ref_grid2').style.display = "none";
}
  clickCount = clickCount+1;
  //show dots
  // document.getElementById('dots').style.display = "block";
});// END CLICK

// CLICK PROJECT
document.getElementById('project').addEventListener('click', function() {
  if (clickCount%2==0) {
  exercises.style.visibility = "hidden";
  reflections.style.visibility = "hidden";
  presentation.style.visibility = "hidden";
  //unhide lists
  document.getElementById('proposal_box').style.display = "block";
  document.getElementById('proposal_mid_grid').style.display = "block";
  document.getElementById('final_box').style.display = "block";
}
else {
  exercises.style.visibility = "visible";
  reflections.style.visibility = "visible";
  presentation.style.visibility = "visible";
  //unhide lists
  document.getElementById('proposal_box').style.display = "none";
  document.getElementById('proposal_mid_grid').style.display = "none";
  document.getElementById('final_box').style.display = "none";
}
  clickCount = clickCount+1;
}); // END CLICK


}
