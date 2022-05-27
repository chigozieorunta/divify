const { src, dest, watch } = require('gulp');

const minify = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');
const sass = require('gulp-sass')(require('sass'));

const minify = () => {
	return src('./includes/**/*.scss')
		.pipe(minify())
		.pipe(autoprefixer())
		.pipe(dest('./'))
}

exports.sass = compile;