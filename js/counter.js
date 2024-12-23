document.addEventListener('DOMContentLoaded', function () {

	function countTo(element, options = {}) {
		const fromNum = options.from || parseFloat(element.getAttribute('data-from')) || 0;
		const toNum = options.to || parseFloat(element.getAttribute('data-to')) || 0;
		const speedNum = options.speed || parseInt(element.getAttribute('data-speed'), 10) || 1000;
		const refreshInterval = options.refreshInterval || parseInt(element.getAttribute('data-refresh-interval'), 10) || 100;
		const decimalsNum = options.decimals || parseInt(element.getAttribute('data-decimals'), 10) || 0;

		if (isNaN(fromNum) || isNaN(toNum)) {
			console.error('Invalid data attributes on element:', element);
			return;
		}

		const formatterNum = options.formatter || function (value) {
			return value.toFixed(decimalsNum);
		};
		const onUpdate = options.onUpdate || function () { };
		const onComplete = options.onComplete || function () { };

		let loopsNum = Math.ceil(speedNum / refreshInterval);
		let incrementNum = (toNum - fromNum) / loopsNum;
		let loopCount = 0;
		let valueNum = fromNum;

		function updateCounter() {
			valueNum += incrementNum;
			loopCount++;

			element.textContent = formatterNum(valueNum);

			onUpdate(valueNum);

			if (loopCount >= loopsNum) {
				clearInterval(intervalNum);
				element.textContent = formatterNum(toNum);
				onComplete(toNum);
			}
		}

		const intervalNum = setInterval(updateCounter, refreshInterval);
		element.textContent = formatterNum(fromNum);
	}

	function createAppearObserver(element, callback, options = {}) {
		const observerNum = new IntersectionObserver((entries) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					callback(entry.target);
					observerNum.unobserve(entry.target);
				}
			});
		}, { threshold: options.threshold || 0.1 });

		observerNum.observe(element);
	}

	const countersNum = document.querySelectorAll('.counter-number');

	countersNum.forEach(counter => {
		createAppearObserver(counter, function () {
			countTo(counter);
		});
	});
});
