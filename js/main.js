 $('#contact-form').submit(function(e) {
    e.preventDefault();
    if (validateForm()) {
        this.submit();
    }
});

function validateForm() {
    let isValid = true;
    $('#contact-form input[required], #contact-form textarea[required]').each(function() {
        if ($(this).val().trim() === '') {
            isValid = false;
            $(this).addClass('error');
        } else {
            $(this).removeClass('error');
        }
    });
    return isValid;
}


function debounce(func, wait) {
    let timeout;
    return function() {
        const context = this, args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            func.apply(context, args);
        }, wait);
    };
}

// Google Maps
function initMap() {
    const ebeyondsLocation = { lat: 6.9271, lng: 79.8612 }; 
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: ebeyondsLocation
    });
    const marker = new google.maps.Marker({
        position: ebeyondsLocation,
        map: map
    });
}


const script = document.createElement('script');
script.src = `https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap`;
script.async = true;
document.head.appendChild(script);

// GSAP animations
gsap.from('.main-visual', { opacity: 0, duration: 1, y: 50 });
gsap.from('.site-introduction', { opacity: 0, duration: 1, y: 50, delay: 0.5 });
gsap.from('#favorites', { opacity: 0, duration: 1, y: 50, delay: 1 });
gsap.from('#contact', { opacity: 0, duration: 1, y: 50, delay: 1.5 });