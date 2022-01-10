// login-register form
function loginRegister (){
    const loginForm = document.querySelector('#loginForm');
    const registerForm = document.querySelector('#registerForm');
    const hideLogin = document.querySelector('#hideLogin');
    const hideRegister = document.querySelector('#hideRegister');

    hideLogin.addEventListener('click', () =>{

      slideUp(loginForm, 1000);

      setTimeout(()=> {
          slideDown(registerForm, 1000);
      }, 1000);
    });

    hideRegister.addEventListener('click', () =>{

      slideUp(registerForm, 1000);
      setTimeout(()=> {
          slideDown(loginForm, 1000);
      }, 1000);
    });
};



/* SLIDE UP */
let slideUp = (target, duration = 500) => {

    target.style.transitionProperty = 'height, margin, padding';
    target.style.transitionDuration = duration + 'ms';
    target.style.boxSizing = 'border-box';
    target.style.height = target.offsetHeight + 'px';
    target.offsetHeight;
    target.style.overflow = 'hidden';
    target.style.height = 0;
    target.style.paddingTop = 0;
    target.style.paddingBottom = 0;
    target.style.marginTop = 0;
    target.style.marginBottom = 0;
    window.setTimeout( () => {
          target.style.display = 'none';
          target.style.removeProperty('height');
          target.style.removeProperty('padding-top');
          target.style.removeProperty('padding-bottom');
          target.style.removeProperty('margin-top');
          target.style.removeProperty('margin-bottom');
          target.style.removeProperty('overflow');
          target.style.removeProperty('transition-duration');
          target.style.removeProperty('transition-property');
          //alert("!");
    }, duration);
};

/* SLIDE DOWN */
let slideDown = (target, duration = 500) => {

    target.style.removeProperty('display');
    let display = window.getComputedStyle(target).display;
    if (display === 'none') display = 'block';
    target.style.display = display;
    let height = target.offsetHeight;
    target.style.overflow = 'hidden';
    target.style.height = 0;
    target.style.paddingTop = 0;
    target.style.paddingBottom = 0;
    target.style.marginTop = 0;
    target.style.marginBottom = 0;
    target.offsetHeight;
    target.style.boxSizing = 'border-box';
    target.style.transitionProperty = "height, margin, padding";
    target.style.transitionDuration = duration + 'ms';
    target.style.height = height + 'px';
    target.style.removeProperty('padding-top');
    target.style.removeProperty('padding-bottom');
    target.style.removeProperty('margin-top');
    target.style.removeProperty('margin-bottom');
    window.setTimeout( () => {
      target.style.removeProperty('height');
      target.style.removeProperty('overflow');
      target.style.removeProperty('transition-duration');
      target.style.removeProperty('transition-property');
    }, duration);
};






// page transition
pageTransition = () => {
    const tl = gsap.timeline();

    tl.to('.transition li', {
      duration: 0.5,
      scaleY: 1.2,
      transformOrigin: 'top left',
      stagger: 0.2
    });
  
    tl.to('.transition li', {
      duration: 0.5,
      scaleY: 0,
      transformOrigin: 'bottom left',
      stagger: 0.1,
      delay: 0.1
    })
};

delay = (n) => {
  n = n || 2000;
  return new Promise((done)=> {
      setTimeout(()=> {
          done();
      }, n);
  })
};


barba.init({
    sync: true,
    views:[
      {
        namespace: 'join-section',
        beforeEnter(){
          loginRegister();
        }
      }
    ],
    transitions: [
        {
            async leave(data) {
                const done = this.async();
                pageTransition();
                await delay(1400);
                done();
            }
        }
    ]
});
