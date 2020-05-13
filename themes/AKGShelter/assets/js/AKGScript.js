console.log("akg script new loaded")

let blueOutlineMarginTopButtonParents = document.querySelectorAll(".is-style-blue-outline-margin-top.wp-block-button").parentNode;
console.log(blueOutlineMarginTopButtonParents);

blueOutlineMarginTopButtonParents.forEach(btnParent => {
    btnParent.classlist.add('marginTop');
});