import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom/client';
import {Button, Snackbar} from "@mui/material";
import { LoadingButton} from '@mui/lab'
import { Alert } from '@mui/material'

import SaveIcon from '@mui/icons-material/Save'

function ExportFile() {

    const [fileName, setFileName] = useState(null)
    const [loading, setLoading] = useState(false)
    const [open, setOpen] = React.useState(false);
    const fileChosen = (event) => {
        setFileName(event.target.files[0].name)
    }

    const cancel = () => {
        setFileName(null)
    }

    const handleClick = () => {
        setOpen(true);
    };

    const handleClose = (event, reason) => {
        if (reason === 'clickaway') {
            return;
        }

        setOpen(false);
    };

    useEffect(() => {
        axios.get('/get-rows').then(function (resr) {
            console.log('result', res)

        })
            .catch(function (err) {
                console.log('error', err);
            })
    })

    const uploadAction = () => {
        setLoading(true)
        const data = new FormData();
        const file = document.querySelector('input[type="file"]').files[0];
        data.append("data", file);
            axios.post('/parse-file',
                data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(function () {
                console.log('SUCCESS!!')
                setLoading(false)
                setOpen(true)
                setFileName(null)
            })
                .catch(function () {
                    console.log('FAILURE!!');
                    setLoading(false)
                })
        }

    return (
        <div className="container">
            <Button
                variant="contained"
                component="label"
            >
                Choose File
                <input
                    type="file"
                    hidden
                    onChange={fileChosen}
                />
            </Button>
            <div>{fileName ? (
                <div>
                    <div className='file-name'>File Name: <b>{fileName}</b></div>
                    <div className='save-button'>
                        <LoadingButton
                            color="primary"
                            onClick={uploadAction}
                            loading={loading}
                            loadingPosition="start"
                            startIcon={<SaveIcon/>}
                            variant="contained"
                        >
                            <span>Save</span>
                        </LoadingButton>
                        <Button onClick={cancel}
                                variant="text"
                        >Cancel</Button>
                    </div>
                </div>
            ) : ('')}</div>
            <Snackbar open={open} autoHideDuration={6000} onClose={handleClose}>
                <Alert onClose={handleClose} severity="success" sx={{ width: '100%' }}>
                    File processing started
                </Alert>
            </Snackbar>
        </div>
    );
}

export default ExportFile;

let container = null;
document.addEventListener('DOMContentLoaded', function (event) {
    if (!container) {
        container = document.getElementById('export');
        if (container) {
            const root = ReactDOM.createRoot(container)
            root.render(
                <React.StrictMode>
                    <ExportFile/>
                </React.StrictMode>
            );
        }
    }
});
