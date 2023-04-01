import './bootstrap';
import './bootstrap-growl.min';
import Swal from 'sweetalert2'

// Notification
Livewire.on('notify', (data)=>{
  notify(data.message, data.type);
});

function notify(message, type){
  $.growl({
      message: message
  },{
      type: type,
      allow_dismiss: false,
      label: 'Cancel',
      className: 'btn-xs btn-'+type,
      placement: {
          from: 'bottom',
          align: 'left'
      },
      delay: 2500,
      animate: {
              enter: 'animated fadeInRight',
              exit: 'animated fadeOutRight'
      },
      offset: {
          x: 30,
          y: 30
      }
  });

  
};

// fadeOut Flash Message
setTimeout(() => {
  $('.flash-message').fadeOut(); 
}, 3000);


// Sweet Alert
Livewire.on('sweet', (data)=>{
  Swal.fire(data)
});

