$(document).ready(() => {
  $("#loan-table").DataTable();

  $("#new-loan").submit((ev) => {
    ev.preventDefault();
    let user = {
      value: $("#user-id").val(),
    };
    const book = {
      value: $("#book-id").val(),
    };

    user.id = $('#users [value="' + user.value + '"]').data("value");
    book.id = $('#books [value="' + book.value + '"]').data("value");

    const form = $("#new-loan");
    let array = form.serializeArray();

    array[0]["value"] = user.id;
    array[1]["value"] = book.id;

    $.ajax({
      type: "POST",
      url: "../models/Loans/alta_l.php",
      traditional: true,
      data: array,
    }).done(() => {
      document.location.reload(true);
    });
  });
});

const update = (id, values) => {
  $.ajax({
    type: "POST",
    url: "../models/Loans/edit_l.php",
    data: { id, ...values },
  }).done(() => {
    document.location.reload(true);
  });
};

const tableToObject = () => {
  let output = {};
  const tableElements = $("tr");

  Array.from(tableElements).forEach((tr) => {
    const childs = tr.querySelectorAll("input");
    if (tr.id) {
      output[tr.id] = {};

      if (childs.length > 0) {
        childs.forEach((child) => {
          if (child.type === "checkbox") {
            if (child.checked) child.value = "1";
            else child.value = "0";
          }

          output[tr.id][child.name] = child.value;
        });
      }
    }
  });

  return output;
};

const oldValues = tableToObject();

$("#update-button").on("click", () => {
  const newValues = tableToObject();

  console.log(newValues);

  for (let loanId in newValues) {
    let newLoan = newValues[loanId];
    let oldLoan = oldValues[loanId];

    if (JSON.stringify(newLoan) !== JSON.stringify(oldLoan))
      update(loanId, newLoan);
  }
});
