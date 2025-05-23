/******/ (() => { // webpackBootstrap
/*!*********************************!*\
  !*** ./src/larris-form/view.js ***!
  \*********************************/
const startApp = () => {
  const submitBtn = document.querySelector("#submitBtn");
  submitBtn.addEventListener("click", () => {
    inputField.forEach(item => {
      item.classList.remove("is-valid");
    });
    emailInput.classList.remove("is-valid");
    textareaEl.classList.remove("is-valid");
  });
  const inputField = document.querySelectorAll(".contact-form__input ");
  inputField.forEach(item => {
    item.addEventListener("input", () => {
      if (item.value.length > 0) {
        item.classList.add("is-valid");
        item.classList.remove("is-error");
      } else {
        item.classList.remove("is-valid");
        item.classList.add("is-error");
      }
    });
  });
  const emailInput = document.getElementById("userEmail");
  emailInput.addEventListener("input", () => {
    const value = emailInput.value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (value === "") {
      emailInput.classList.remove("is-valid", "is-error");
    } else if (emailPattern.test(value)) {
      emailInput.classList.add("is-valid");
      emailInput.classList.remove("is-error");
    } else {
      emailInput.classList.add("is-error");
      emailInput.classList.remove("is-valid");
    }
  });
  const textareaEl = document.querySelector(".contact-form__textarea");
  textareaEl.addEventListener("input", () => {
    if (textareaEl.value.length > 0) {
      textareaEl.classList.add("is-valid");
      textareaEl.classList.remove("is-error");
    } else {
      textareaEl.classList.remove("is-valid");
      textareaEl.classList.add("is-error");
    }
  });
};
document.addEventListener("DOMContentLoaded", () => {
  const labelEl = document.querySelector(".contact-form__label");
  const inputField = document.querySelectorAll("input");
  inputField.forEach(item => {
    changeFont(item, labelEl);
  });
  const textareaField = document.querySelector(".contact-form__textarea");
  changeFont(textareaField, labelEl);
  const submitBtn = document.querySelector("#submitBtn");
  changeFont(submitBtn, labelEl);
  startApp();
});
const getFontFamily = element => {
  if (element) {
    const fontFamily = window.getComputedStyle(element).fontFamily;
    console.log("Font size of the label:", fontFamily);
    return fontFamily;
  } else {
    console.log("Label element not found.");
  }
};
const changeFont = (element, sourceEl) => {
  const getFont = getFontFamily(sourceEl);
  element.style.fontFamily = getFont;
};
/******/ })()
;
//# sourceMappingURL=view.js.map