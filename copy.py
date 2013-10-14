import os
from shutil import copytree, rmtree


ROOT = os.path.dirname(__file__)
APP_ROOT = os.path.join(ROOT, "nhpcc")
WEB_ROOT = os.path.join(ROOT, 'wwwroot')


dir_join = lambda path: (os.path.join(APP_ROOT, 'assets', path),
                         os.path.join(WEB_ROOT, 'static', path))

def copy_dirs(src_path, dst_path):
    '''delete files and folders'''
    if os.path.isdir(dst_path):
        rmtree(dst_path)
        print 'Deleting', dst_path
    copytree(src_path, dst_path)


paths = [dir_join('components'), dir_join('styles'), dir_join('scripts')]
[copy_dirs(src_path, dst_path) for src_path, dst_path in paths]

print "Finished copying"
