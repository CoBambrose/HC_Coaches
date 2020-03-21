window.addEventListener("scroll", (e) => {
  let scrollY = window.pageYOffset;
  document.querySelector('body').style.backgroundPosition = 'center '+String(scrollY*0.6)+'px';
});

function updateTable(className, dataHref, useJQuery=false) {
  // JQuery method
  if (useJQuery) {
    $("."+className).load(dataHref);
  }
  // Vanilla JS method
  else {
    let request = new XMLHttpRequest();
    request.open('GET', dataHref, true);
    request.onload = () => {
      if (request.status >=200 && request.status <= 400) {
        let resp = request.responseText;
        document.getElementsByClassName(className)[0].innerHTML = resp;
      }
    }
    request.send();
  }
}

function initApp() {
  updateTable("coach-table", "./live/studentCoaches.php");
  setInterval(() => {
    updateTable("coach-table", "./live/studentCoaches.php");
  }, 3000);
}

function driverAction(_option="") {
  if (_option != "") {
    let options;
    switch (_option) {
      case "add":
        document.location.href="../action/?action=add";
        break;
      case "load":
        options = document.querySelector("select").options;
        if (options.selectedIndex > 0) {
          let selected = options[options.selectedIndex].value;
          document.location.href="../action/?action=load&id="+selected;
        }
        break;
      case "remove":
        options = document.querySelector("select").options;
        if (options.selectedIndex > 0) {
          let selected = options[options.selectedIndex].value;
          document.location.href="../action/?action=remove&id="+selected;
        }
        break;
      case "logout":
        document.location.href = '../';
        break;
    }
  }
}

let currentField = undefined;

function updateData(dataField) {
  let fields = ["coachPosition", "coachCapacity", "coachStatus", "coachRelTime"];
  for (let field of fields) {
    document.querySelector(".change ."+field).style.display = 'none';
  }
  document.querySelector(".change ."+dataField).style.display = 'grid';
  currentField = dataField;
}

function submitUpdateData() {
  let selected;
  options = document.querySelector("."+currentField+" select").options;
  selected = options[options.selectedIndex].value;
  document.location.href = "./?mode=update&field="+currentField+"&data="+selected+"&id="+id;
}

function managerAction(_option="") {
  if (_option != "") {
    switch (_option) {
      case "drivers":
        document.location.href = './drivers/';
        break;
      case "coaches":
        document.location.href = './coaches/';
        break;
      case "spectate":
        document.location.href = './spectate/';
        break;
      case "logout":
        document.location.href = '../';
        break;
    }
  }
}

function managerDriversAction() {
  let select = document.querySelectorAll("select")[1];
  let selected = select.options[select.options.selectedIndex].value;
  let p = document.querySelectorAll("p");
  let input = document.querySelectorAll("input");
  let elts = [];
  for (let i = 0; i < input.length; i++) {
    elts.push((_toggle=true) => {
      p[i+2].style.display = _toggle ? "block" : "none";
      input[i].style.display = _toggle ? "block" : "none";
    });
  }
  switch (selected) {
    case "verify":
      for (elt of elts) {elt(false)}
      elts[0]();
      break;
    case "change":
      for (elt of elts) {elt(false)}
      elts[1]();
      break;
    case "changeUID":
      for (elt of elts) {elt(false)}
      elts[2]();
      break;
    default:
      for (elt of elts) {elt(false)}
  }
}
