document.addEventListener('DOMContentLoaded', function() {
  
	// 计数器功能
	function countTo(element, options = {}) {
	  const from = options.from || parseInt(element.getAttribute('data-from'), 10) || 0;
	  const to = options.to || parseInt(element.getAttribute('data-to'), 10) || 0;
	  const speed = options.speed || parseInt(element.getAttribute('data-speed'), 10) || 1000;
	  const refreshInterval = options.refreshInterval || parseInt(element.getAttribute('data-refresh-interval'), 10) || 100;
	  const decimals = options.decimals || parseInt(element.getAttribute('data-decimals'), 10) || 0;
	  
	  // 确保 to 和 from 都是有效数字
	  if (isNaN(from) || isNaN(to)) {
		console.error('Invalid data attributes on element:', element);
		return;
	  }
  
	  const formatter = options.formatter || function(value) {
		return value.toFixed(decimals);
	  };
	  const onUpdate = options.onUpdate || function() {};
	  const onComplete = options.onComplete || function() {};
  
	  let loops = Math.ceil(speed / refreshInterval);
	  let increment = (to - from) / loops;
	  let loopCount = 0;
	  let value = from;
  
	  function updateCounter() {
		value += increment;
		loopCount++;
  
		element.textContent = formatter(value);
  
		onUpdate(value);
  
		if (loopCount >= loops) {
		  clearInterval(interval);
		  element.textContent = formatter(to);
		  onComplete(to);
		}
	  }
  
	  const interval = setInterval(updateCounter, refreshInterval);
	  element.textContent = formatter(from);
	}
  
	// 使用 IntersectionObserver 进行元素出现检测
	function createAppearObserver(element, callback, options = {}) {
	  const observer = new IntersectionObserver((entries) => {
		entries.forEach(entry => {
		  if (entry.isIntersecting) {
			callback(entry.target);
			observer.unobserve(entry.target);  // 一旦出现，不再继续观察
		  }
		});
	  }, { threshold: options.threshold || 0.1 });
  
	  observer.observe(element);
	}
  
	// 选择所有的 .counter-number 元素并启动计数器
	const counters = document.querySelectorAll('.counter-number');
  
	counters.forEach(counter => {
	  createAppearObserver(counter, function() {
		countTo(counter);
	  });
	});
  });
  