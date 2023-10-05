import shutil
import os

def find_folder_path(root_dir, folder_name):
    for folder_path, _, _ in os.walk(root_dir):
        if os.path.basename(folder_path) == folder_name:
            return folder_path
    return None

root_directory = 'C:'  # Replace with the directory you want to start the search from
folder_to_find = 'xampp'  # Replace with the name of the folder you want to find

folder_path = find_folder_path(root_directory, folder_to_find)

if folder_path:
    xampp_dir = "C:/xampp/"
    repo_dir = "C:/simple-php-app/"
else:
    xampp_dir = "E:/xampp/"
    repo_dir = "E:/simple-php-app/"

print(xampp_dir)

dest_dir = xampp_dir+"htdocs/simple"
source_dir = repo_dir+"htdocs/simple"
print(source_dir)
print(dest_dir)
shutil.copytree(source_dir,dest_dir,dirs_exist_ok=True)
dest_dir = xampp_dir+"mysql/data/simple_fansite"
source_dir = repo_dir+"mysql/data/simple_fansite"
print(source_dir)
print(dest_dir)
shutil.copytree(source_dir,dest_dir,dirs_exist_ok=True)

input("Press ENTER to close.")