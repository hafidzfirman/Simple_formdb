function gel(selector) {
    return document.querySelector(selector);
}

// regex validasi email
function isValidEmail(email) {
    const res = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    const xxx = res.test(String(email).toLowerCase());
    // console.log(xxx);

    return xxx; // it's either true or false
}

// regex validasi nomor telepon indonesia
function isValidPhone(number) {
    var phoneRe = /^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/g;
    var digits = number.replace(/\D/g, "");
    var xxx = phoneRe.test(digits);
    // console.log(xxx);

    return xxx; // it's either true or false
}

// jadikan semua isi form menjadi JSON
function serializeJSON(form) {
    formData = new FormData(gel(form));
    const pairs = {};
    for (const [name, value] of formData) {
        pairs[name] = value;
    }

    var output = JSON.stringify(pairs, null, 2);
    // console.log(output);
    return output; // output as JSON
}

// reset form
function resetForm() {
    gel('#theform').reset();

    // set default value for birthday to 18 years ago
    var eighteenYearsAgo = new Date();
    var eighteenYearsAgo = eighteenYearsAgo.setFullYear(eighteenYearsAgo.getFullYear()-18);
    var a = new Date(eighteenYearsAgo);
    var theDate = a.getFullYear() + '-' + ('0'+a.getMonth()).slice(-2) + '-' + ('0'+a.getDate()).slice(-2);
    // console.log(theDate);
    gel('#birthday').value = theDate;
    gel('#birthday').setAttribute('max',theDate); // khusus 18+
}

// what to do when user clicked submit button
function insert_data_to_table() {
    // gather up the form fata
    var obj = JSON.parse(serializeJSON('#theform'));

    if( // test the data to check if it's fulfilling the conditions
        obj.name != '' &&
        obj.address != '' &&
        obj.birthday != '' &&
        isValidEmail(obj.email) == true &&
        isValidPhone(obj.phone) == true
    ) { // it's a green!
        // do nothing, let the event flows
    } else { // pull back! pull back!! pull back!!
        alert('STOP RIGHT THERE, CRIMINAL SCUM!!');
        event.preventDefault();
    }
}

// user clicked submit button, do something!
gel('#submit').addEventListener('click', insert_data_to_table);

// the document has been loaded, do something!
document.addEventListener('DOMContentLoaded', (e) => {
    resetForm();
});