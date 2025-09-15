const images = [
    "../images/register.jpg",
    "../images/register2.jpg",
    "../images/register3.png",
    "../images/register4.jpg",
    "../images/register5.jpg",
];

const randomIndex = Math.floor(Math.random() * images.length);
document.addEventListener("DOMContentLoaded", () => {
    const hero = document.getElementById("pozadinaLogo");
    if (pozadinaLogo) {
        pozadinaLogo.style.backgroundImage = `url('${images[randomIndex]}')`;
    }
});
