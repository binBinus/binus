const DAY_MAP = {
  0: "sun"
};

function getFirstDayOfMonth() {
  const temp = new Date(this);
  temp.setDate(1);
  return temp.getDay();
}
Date.prototype.getFirstDayOfMonth = getFirstDayOfMonth;

let date = new Date();
let todayDate = new Date(date);
const calendar = document.querySelector(".calendar");
const next = document.querySelector(".next");
const prev = document.querySelector(".prev");
const domDate = document.querySelector(".date");

function getDayMarkUp(day = "", isToday = false) {
  return `<p class="day ${isToday ? "today" : ""}">${day}</p>`;
}

next.addEventListener("click", handleNextMonthClick);
prev.addEventListener("click", handlePrevMonthClick);

function fillFirstDaysAsEmpty(days) {
  for (let i = 0; i < days; i++) {
    calendar.insertAdjacentHTML("beforeend", getDayMarkUp());
  }
}

function fillRestOfTheDays() {
  const currentMonth = date.getMonth();
  const currentYear = date.getFullYear();
  date.setDate(1);
  while (currentMonth === date.getMonth()) {
    const currentDate = date.getDate();
    const isToday =
      todayDate.getDate() === currentDate &&
      currentMonth === todayDate.getMonth() &&
      currentYear === todayDate.getFullYear();
    calendar.insertAdjacentHTML(
      "beforeend",
      getDayMarkUp(currentDate, isToday)
    );
    date.setDate(currentDate + 1);
  }
}

function handleNextMonthClick() {
  render();
}

function handlePrevMonthClick() {
  date.setDate(1);
  date.setMonth(date.getMonth() - 2);
  render();
}

function clearDays() {
  const days = [...(document.querySelectorAll(".day") ?? [])] ?? [];
  days.forEach((day) => {
    day.remove();
  });
}

function fillDOMDate() {
  domDate.textContent = `${date.getFullYear()} - ${date.getMonth() + 1}`;
}

render();

function render() {
  clearDays();
  fillDOMDate();
  fillFirstDaysAsEmpty(date.getFirstDayOfMonth());
  fillRestOfTheDays();
}
