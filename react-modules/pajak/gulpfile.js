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
    'rm -rf ../../pajak/*'
]));

gulp.task('mkdir:pajak', function(callback) {
    if(!fs.existsSync('../../pajak')) {
        fs.mkdirSync('../../pajak')
    }

    callback();
});

gulp.task('cp:build', shell.task([
    'cp -rf build/* ../../pajak/'
]));

gulp.task('cp:htaccess', shell.task([
    'cp ../../.htaccess ../../pajak/.htaccess'
]));

gulp.task('cp:index', shell.task([
    'cp build/index.html ../../application/apps/pajak/views/v_pajak.php && cp build/index.html ../../pajak/index.php && rm -f ../../pajak/index.html'
]));

gulp.task('build:check', function (callback) {
    runInSequence('run:lint', callback);
});

gulp.task('build', function (callback) {
    runInSequence('run:build', 'clean', 'mkdir:pajak', 'cp:build', 'cp:htaccess', 'cp:index', 'edit:indexPhp', 'edit:precachemanifest', 'edit:assetmanifest', 'edit:service-worker.js', callback);
});


// function setSw(content) {
//     return content.replace(/importScripts(\s+pajak/, 'mersi-frontend-react/pajak');
// }

// gulp.task('edit:sw', function () {
//     return gulp.src('../../pajak/service-worker.js')
//         .pipe(change(setSw))
//         .pipe(gulp.dest('../../pajak/'));
// })
//
// function setIndexPhp (content) {
//     return content.replace("');
// }


gulp.task('edit:indexPhp', function () {
    return gulp.src('../../pajak/index.php')
        .pipe(replace('/pajak/', function() {
            return '<?php echo "http://" . $_SERVER[\'HTTP_HOST\'].preg_replace(\'@/+$@\', \'\', dirname($_SERVER[\'SCRIPT_NAME\'])) . \'/\'; ?>';
        }))
        .pipe(gulp.dest('../../pajak/'));
});

gulp.task('edit:precachemanifest', function () {
    return gulp.src('../../pajak/precache-manifest.*')
        .pipe(replace('/pajak/', function () {
            return '';
        }))
        .pipe(replace('index.html', 'index.php'))
        .pipe(gulp.dest('../../pajak/'));
})

gulp.task('edit:assetmanifest', function () {
    return gulp.src('../../pajak/asset-manifest.json')
        .pipe(replace('/pajak/', function () {
            return '';
        }))
        .pipe(gulp.dest('../../pajak/'));
})

gulp.task('edit:service-worker.js', function () {
    return gulp.src('../../pajak/service-worker.js')
        .pipe(replace(/importScripts\(\s[  ]{2,}/, function () {
            return 'function getBasename(path) {\n' +
                '    return path.substr(0, path.lastIndexOf(\'/pajak\'));\n' +
                '};\n' +
                'var base = getBasename(self.location.pathname)?getBasename(self.location.pathname): \'\';\n' +
                'importScripts(\n' +
                'base+';
        }))
        .pipe(replace(new RegExp(/workbox.routing.registerNavigationRoute\(workbox.precaching.getCacheKeyForURL\("\/pajak\/index.html"\)[,\/][  ]{1,}\{/), function () {
            return '';
        }))
        .pipe(replace(new RegExp(/[ ]{2,}blacklist: \[\/\^\\\/_\/,\/\\\/\[\^\\\/\?]\+\\.\[\^\\\/]\+\$\/],\n\}\)\;/g),function () {
            return 'workbox.routing.registerRoute(new RegExp(self.location.hostname+base),  new workbox.strategies.CacheFirst())';
        }))
        // .pipe(replace(/[  ]{2,}blacklist/), function () {
        //     return '//blacklist';
        // })
        .pipe(gulp.dest('../../pajak/'));
});



gulp.task('start', function (callback) {
    runInSequence('run:start', callback);
});
