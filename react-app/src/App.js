import './App.scss';
import Api from './Api';
import {useEffect, useState} from "react";
import {Box, CircularProgress} from "@mui/material";
import Form from "./components/form/Form";

function App() {
    const [loading, setLoading] = useState(true);
    const [title, setTitle] = useState('');
    const [subject, setSubject] = useState('');

    useEffect(() => {
        if (loading && title === '') {
            Api
                .getVariables()
                .then(data => {
                    if (data && data.cf_settings_title) {
                        const _title = data.cf_settings_title;
                        setTitle(_title);
                    }
                    setLoading(false);
                })
        }
    }, [loading]);

    const createEntry = () => {
        setLoading(true);
        Api
            .createEntry({subject})
            .then(data => {
                if (data) {

                }
                setLoading(false);
            });
    }

    return (
        <div className="calc-wrapper">
            {loading ? (<>
                <Box className="cf-loader">
                    <CircularProgress/>
                </Box>
            </>) : (<>
                {title ? (<>
                        <Form
                            title={title}
                            values={{subject}}
                            setters={{setSubject}}
                            handleSubmit={createEntry}
                        />
                    </>
                ) : (<></>)}
            </>)}
        </div>
    );
}

export default App;
