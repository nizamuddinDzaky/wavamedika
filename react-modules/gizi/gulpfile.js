var gulp = require('gulp');
var shell = require('gulp-shell');
var runInSequence = require('gulp4-run-sequence');
var change = require('gulp-change');
var replace = require('gulp-replace');
var fs = require('fs');

gulp.task('cp:types', shell.task([
    'cp -r ./typetemporary/* ./node_modules/@types/'
]));

gulp.task('run:start', shell.task([
    '"./node_modules/.bin/react-scripts" start'
]));

gulp.task('run:build', shell.task([
    '"./node_modules/.bin/react-scripts" build'
]));

gulp.task('run:lint', shell.task([
    '"./node_modules/.bin/eslint" ./src'
]));

gulp.task('clean', shell.task([
    'rm -rf ../../gizi/*'
]));

gulp.task('mkdir:gizi', function(callback) {
    if(!fs.existsSync('../../gizi')) {
        fs.mkdirSync('../../gizi')
    }

    callback();
});

gulp.task('cp:build', shell.task([
    'cp -rf build/* ../../gizi/'
]));

gulp.task('cp:htaccess', shell.task([
    'cp ../../.htaccess ../../gizi/.htaccess'
]));

gulp.task('cp:index', shell.task([
    'cp build/index.html ../../application/apps/gizi/views/v_gizi.php && cp build/index.html ../../gizi/index.php && rm -f ../../gizi/index.html'
]));

gulp.task('build:check', function (callback) {
    runInSequence('run:lint', callback);
});

gulp.task('build', function (callback) {
    runInSequence('run:build', 'clean', 'mkdir:gizi', 'cp:build', 'cp:htaccess', 'cp:index', 'edit:indexPhp', 'edit:precachemanifest', 'edit:assetmanifest', 'edit:service-worker.js', callback);
});


// function setSw(content) {
//     return content.replace(/importScripts(\s+gizi/, 'mersi-frontend-react/gizi');
// }

// gulp.task('edit:sw', function () {
//     return gulp.src('../../gizi/service-worker.js')
//         .pipe(change(setSw))
//         .pipe(gulp.dest('../../gizi/'));
// })
//
// function setIndexPhp (content) {
//     return content.replace("');
// }


gulp.task('edit:indexPhp', function () {
    return gulp.src('../../gizi/index.php')
        .pipe(replace('/gizi/', function() {
            return '<?php echo "http://" . $_SERVER[\'HTTP_HOST\'].preg_replace(\'@/+$@\', \'\', dirname($_SERVER[\'SCRIPT_NAME\'])) . \'/\'; ?>';
        }))
        .pipe(gulp.dest('../../gizi/'));
});

gulp.task('edit:precachemanifest', function () {
    return gulp.src('../../gizi/precache-manifest.*')
        .pipe(replace('/gizi/', function () {
            return '';
        }))
        .pipe(replace('index.html', 'index.php'))
        .pipe(gulp.dest('../../gizi/'));
})

gulp.task('edit:assetmanifest', function () {
    return gulp.src('../../gizi/asset-manifest.json')
        .pipe(replace('/gizi/', function () {
            return '';
        }))
        .pipe(gulp.dest('../../gizi/'));
})

gulp.task('edit:service-worker.js', function () {
    return gulp.src('../../gizi/service-worker.js')
        .pipe(replace(/importScripts\(\s[  ]{2,}/, function () {
            return 'function getBasename(path) {\n' +
                '    return path.substr(0, path.lastIndexOf(\'/gizi\'));\n' +
                '};\n' +
                'var base = getBasename(self.location.pathname)?getBasename(self.location.pathname): \'\';\n' +
                'importScripts(\n' +
                'base+';
        }))
        .pipe(replace(new RegExp(/workbox.routing.registerNavigationRoute\(workbox.precaching.getCacheKeyForURL\("\/gizi\/index.html"\)[,\/][  ]{1,}\{/), function () {
            return '';
        }))
        .pipe(replace(new RegExp(/[ ]{2,}blacklist: \[\/\^\\\/_\/,\/\\\/\[\^\\\/\?]\+\\.\[\^\\\/]\+\$\/],\n\}\)\;/g),function () {
            return 'workbox.routing.registerRoute(new RegExp(self.location.hostname+base),  new workbox.strategies.CacheFirst())';
        }))
        // .pipe(replace(/[  ]{2,}blacklist/), function () {
        //     return '//blacklist';
        // })
        .pipe(gulp.dest('../../gizi/'));
});



gulp.task('start', function (callback) {
    runInSequence('run:start', callback);
});
